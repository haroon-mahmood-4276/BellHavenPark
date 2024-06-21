<?php

namespace App\DataTables;

use App\Models\Payment;
use App\Utils\Enums\CustomerAccounts;
use App\Utils\Traits\DataTableTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;

class ReportsDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('account', function ($row) {
                return editBadgeColumn(Str::of($row->account->value)->headline() ?? '-');
            })
            ->editColumn('payment_method.name', function ($row) {
                return $row->payment_method->name ?? '-';
            })
            ->editColumn('credit_amount', function ($row) {
                return editPaymentColumn($row->credit_amount, 2);
            })
            ->editColumn('debit_amount', function ($row) {
                return editPaymentColumn($row->debit_amount, 2);
            })
            ->editColumn('payment_from', function ($row) {
                return editDateColumn($row->payment_from, 'F j, Y');
            })
            ->editColumn('payment_to', function ($row) {
                return editDateColumn($row->payment_to, 'F j, Y');
            })
            ->editColumn('comments', function ($row) {
                $comments = Str::of($row->comments);
                return $comments->length() > 0 ? Str::of($row->comments)->words(10) : '-';
            })
            ->editColumn('created_at', function ($row) {
                return editDateTimeColumn($row->created_at);
            })
            ->rawColumns($columns);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model): QueryBuilder
    {
        return $model->newQuery()->select('payments.*')->whereBetween('payments.created_at', [$this->report_from, $this->report_to])->whereNot('account', CustomerAccounts::CREDIT_ACCOUNT)->with(['booking', 'payment_method', 'booking.cabin', 'booking.customer']);
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('customers.export')) {
            $buttons[] = Button::make('export')
                ->addClass('btn btn-primary waves-effect waves-float waves-light dropdown-toggle m-1')
                ->buttons([
                    Button::make('print')->addClass('dropdown-item')->text('<i class="fa-solid fa-print"></i>&nbsp;&nbsp;Print'),
                    Button::make('copy')->addClass('dropdown-item')->text('<i class="fa-solid fa-copy"></i>&nbsp;&nbsp;Copy'),
                    Button::make('csv')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-csv"></i>&nbsp;&nbsp;CSV'),
                    Button::make('excel')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-excel"></i>&nbsp;&nbsp;Excel'),
                    Button::make('pdf')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-pdf"></i>&nbsp;&nbsp;PDF'),
                ]);
        }

        $buttons = array_merge($buttons, [
            Button::make('reset')->addClass('btn btn-danger waves-effect waves-float waves-light m-1'),
            Button::make('reload')->addClass('btn btn-primary waves-effect waves-float waves-light m-1'),
        ]);

        return $this->builder()
            ->setTableId('daily-reports-table')
            ->addTableClass('table-borderless table-striped table-hover')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide()
            ->stateSave()
            ->processing()
            ->deferRender()
            ->scrollX()
            ->pagingType('full_numbers')
            ->lengthMenu([
                [30, 50, 70, 100, 120, 150, 200],
                [30, 50, 70, 100, 120, 150, 200],
            ])
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"d-flex justify-content-between mx-0 pb-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            ->rowGroup([
                'startRender' => "function (rows, group, level) {
                    if (level > 0) {
                        return group + ' (' + rows.count() + ')';
                    }
                    return group;
                }",
                'endRender' => "function (rows, group, level) {
                    var totalCreditAmount = rows.data().pluck('credit_amount').reduce(function (a, b) {
                        return parseFloat(parseFloat(a) + parseFloat(b === '-' ? 0 : b.replace(/[,$]/g, '')));
                    }, 0);
                    var totalDebitAmount = rows.data().pluck('debit_amount').reduce(function (a, b) {
                        return parseFloat(parseFloat(a) + parseFloat(b === '-' ? 0 : b.replace(/[,$]/g, '')));
                    }, 0);

                    if (level > 0) {
                        return $('<tr/>').append('<td class=\'fw-bold\' colspan=\'7\'>' + group + ' (' + rows.count() + ')</td>').append('<td class=\'text-center\'>' + '$ ' + totalCreditAmount.toFixed(2) + '</td>').append('<td class=\'text-center\'>' + '$ ' + totalDebitAmount.toFixed(2) + '</td>').append('<td colspan=\'2\'></td>');
                    }
                    return $('<tr/>').append('<td class=\'fw-bold\' colspan=\'7\'>' + group + '</td>').append('<td class=\'text-center\'>' + '$ ' + totalCreditAmount.toFixed(2) + '</td>').append('<td class=\'text-center\'>' + '$ ' + totalDebitAmount.toFixed(2) + '</td>').append('<td colspan=\'2\'></td>');
                }",
                'dataSrc' => ['booking.cabin.name'],
            ])
            ->orders([
                [1, 'asc'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $class = 'text-nowrap text-center align-middle';
        return [
            Column::make('id')->title('Trans No.')->addClass($class),
            Column::make('booking.customer.first_name')->title('Cabin')->addClass($class),
            Column::make('booking.customer.last_name')->title('Cabin')->addClass($class),
            Column::make('account')->addClass($class),
            Column::make('payment_method.name')->title('Payment Method')->addClass($class),
            Column::make('payment_from')->title('Payment From')->addClass($class),
            Column::make('payment_to')->title('Payment To')->addClass($class),
            Column::make('credit_amount')->addClass($class),
            Column::make('debit_amount')->addClass($class),
            Column::make('created_at')->title('Paid at')->addClass($class),
            Column::make('comments')->title('Comments')->addClass($class),
            // Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass($class),
        ];
    }
}
