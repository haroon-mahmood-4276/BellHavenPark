<?php

namespace App\DataTables;

use App\Models\Payment;
use App\Utils\Enums\CustomerAccounts;
use App\Utils\Enums\PaymentStatus;
use App\Utils\Enums\TransactionType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class BookingPaymentsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('amount', function ($row) {
                return editPaymentColumn($row->amount, 2);
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
            ->editColumn('transaction_type', function ($row) {
                return Str::of($row->transaction_type->value)->replace('_', ' ')->title();
            })
            ->editColumn('status', function ($row) {
                return Str::of($row->status->value)->replace('_', ' ')->title();
            })
            ->editColumn('updated_at', function ($row) {
                return editDateTimeColumn($row->updated_at);
            })
            ->addIndexColumn()
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->newQuery()
            ->select('payments.*')
            ->with(['payment_method'])
            ->where('payments.booking_id', $this->booking_id)
            ->where(function (QueryBuilder $query) {
                $query->where('payments.account', '!=', CustomerAccounts::CREDIT_ACCOUNT)
                    ->orwhere('payments.status', '!=', PaymentStatus::PAID);
            });
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('bookings.payments.create')) {
            $buttons[] = Button::make('collection')
                ->addClass('btn btn-primary waves-effect waves-float waves-light dropdown-toggle m-1 btn-add-payment-collection')
                ->text('Add Payment')->autoClose(true)
                ->buttons([
                    Button::raw('add-rent-payment')
                        ->addClass('dropdown-item m-1')
                        ->text('<i class="fa-solid fa-plus me-1"></i>Add Rent Payment')
                        ->action('addNew("rent_payment")'),
                    
                    '<hr><h4 class="dropdown-header m-2">Utilities</h4>',
                   
                    Button::raw('add-electricity-payment')
                        ->addClass('dropdown-item m-1')
                        ->text('<i class="fa-solid fa-plug-circle-bolt me-1"></i>Electricity Payment')
                        ->action('addNew("electricity_payment")'),
                   
                    Button::raw('add-gas-payment')
                        ->addClass('dropdown-item m-1')
                        ->text('<i class="fa-solid fa-fire-flame-simple me-1"></i>Gas Payment')
                        ->action('addNew("gas_payment")'),
                   
                    Button::raw('add-water-payment')
                        ->addClass('dropdown-item m-1')
                        ->text('<i class="fa-solid fa-droplet me-1"></i>Water Payment')
                        ->action('addNew("water_payment")'),
                ]);
        }

        if (auth()->user()->can('bookings.payments.export')) {
            $buttons[] = Button::make('export')
                ->addClass('btn btn-primary waves-effect waves-float waves-light dropdown-toggle m-1')
                ->buttons([
                    Button::make('print')->addClass('dropdown-item')->text('<i class="fa-solid fa-print me-1"></i>Print'),
                    Button::make('copy')->addClass('dropdown-item')->text('<i class="fa-solid fa-copy me-1"></i>Copy'),
                    Button::make('csv')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-csv me-1"></i>CSV'),
                    Button::make('excel')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-excel me-1"></i>Excel'),
                    Button::make('pdf')->addClass('dropdown-item')->text('<i class="fa-solid fa-file-pdf me-1"></i>PDF'),
                ]);
        }

        $buttons = array_merge($buttons, [
            Button::make('reset')->addClass('btn btn-danger waves-effect waves-float waves-light m-1'),
            Button::make('reload')->addClass('btn btn-primary waves-effect waves-float waves-light m-1'),
        ]);

        return $this->builder()
            ->setTableId('booking-table')
            ->addTableClass('table-borderless table-striped table-hover')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide()
            ->processing()
            ->deferRender()
            ->scrollX()
            ->pagingType('full_numbers')
            ->lengthMenu([
                [30, 50, 70, 100, 120, 150, -1],
                [30, 50, 70, 100, 120, 150, "All"],
            ])
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"d-flex justify-content-between mx-0 pb-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            // ->rowGroupDataSrc('parent_id')
            // ->columnDefs([
            //     [
            //         'targets' => 0,
            //         'className' => 'text-center text-primary',
            //         'width' => '10%',
            //         'orderable' => false,
            //         'searchable' => false,
            //         'responsivePriority' => 3,
            //         'render' => "function (data, type, full, setting) {
            //             var role = JSON.parse(data);
            //             return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"checkForDelete[]\" id=\"checkForDelete_' + role.id + '\" /><label class=\"form-check-label\" for=\"chkRole_' + role.id + '\"></label></div>';
            //         }",
            //         'checkboxes' => [
            //             'selectAllRender' =>  '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
            //         ]
            //     ],
            // ])
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
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false)->addClass('text-nowrap text-center align-middle'),
            Column::make('transaction_type')->title('Transaction Type')->addClass('text-nowrap text-center align-middle'),
            Column::make('payment_method.name')->title('Payment Method')->addClass('text-nowrap text-center align-middle'),
            Column::make('payment_from')->title('Payment From')->addClass('text-nowrap text-center align-middle'),
            Column::make('payment_to')->title('Payment To')->addClass('text-nowrap text-center align-middle'),
            Column::make('amount')->addClass('text-nowrap text-center align-middle'),
            Column::make('status')->addClass('text-nowrap text-center align-middle'),
            Column::make('comments')->title('Comments')->addClass('text-nowrap text-center align-middle'),
            Column::make('updated_at')->addClass('text-nowrap text-center align-middle'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'booking_' . date('YmdHis');
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = Pdf::loadView($this->printPreview, ['data' => $data])->setOption(['defaultFont' => 'sans-serif']);
        return $pdf->download($this->filename() . '.pdf');
    }
}
