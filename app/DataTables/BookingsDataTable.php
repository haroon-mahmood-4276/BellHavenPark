<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Utils\Traits\DataTableTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingsDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('check', function ($booking) {
                return $booking;
            })
            ->editColumn('customer.first_name', function ($booking) {
                return $booking->customer->first_name . " " . $booking->customer->last_name;
            })
            ->editColumn('booking_source.name', function ($booking) {
                return !is_null($booking->booking_source) ? $booking->booking_source->name : '-';
            })
            ->editColumn('booking_from', function ($booking) {
                return editDateColumn($booking->booking_from, 'F j, Y');
            })
            ->editColumn('booking_to', function ($booking) {
                return editDateColumn($booking->booking_to, 'F j, Y');
            })
            ->editColumn('check_in_date', function ($booking) {
                return $booking->check_in_date > 0 ? editDateTimeColumn($booking->check_in_date, 'F j, Y') : '...';
            })
            ->editColumn('check_out_date', function ($booking) {
                return $booking->check_out_date > 0 ? editDateTimeColumn($booking->check_out_date, 'F j, Y') : '...';
            })
            ->editColumn('created_at', function ($booking) {
                return editDateTimeColumn($booking->created_at, 'F j, Y');
            })
            ->editColumn('updated_at', function ($booking) {
                return editDateTimeColumn($booking->updated_at, 'F j, Y');
            })
            ->editColumn('actions', function ($booking) {
                return view('bookings.actions', ['booking' => $booking, 'filter' => $this->filter]);
            })
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Booking $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Booking $model)
    {
        $modelQuery = $model->newQuery()->select('bookings.*')->with(['booking_source', 'customer', 'cabin']);
        if (!is_null($this->filter) && $this->filter == 'checkin') {
            $modelQuery->where('check_in_date', 0);
        }
        if (!is_null($this->filter) && $this->filter == 'checkout') {
            $modelQuery->where('check_in_date', '>', 0)->where('check_out_date', 0);
        }
        return $modelQuery;
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('bookings.create')) {
            $buttons[] = Button::raw('add-new')
                ->addClass('btn btn-primary waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add New')
                ->attr([
                    'onclick' => 'addNew()',
                ]);
        }

        if (auth()->user()->can('bookings.export')) {
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

        if (auth()->user()->can('bookings.destroy')) {
            $buttons[] = Button::raw('delete-selected')
                ->addClass('btn btn-danger waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-minus"></i>&nbsp;&nbsp;Delete Selected')
                ->attr([
                    'onclick' => 'deleteSelected()',
                ]);
        }

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
                [30, 50, 70, 100, 120, 150, 200],
                [30, 50, 70, 100, 120, 150, 200],
            ])
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"d-flex justify-content-between mx-0 pb-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            ->fixedColumns([
                'left' => 0,
                'right' => 1,
            ])
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
                [9, 'desc'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $checkColumn = Column::computed('check')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle');

        if (auth()->user()->can('bookings.destroy')) {
            $checkColumn->addClass('disabled');
        }

        $columns = [
            // $checkColumn,
            Column::make('booking_number')->title('ID')->addClass('text-nowrap text-center align-middle'),

            Column::make('customer.first_name')->title('Customer')->addClass('text-nowrap text-center align-middle'),
            Column::make('customer.last_name')->title('Customer')->visible(false)->printable(false)->exportable(false)->orderable(false)->addClass('text-nowrap text-center align-middle'),

            Column::make('cabin.name')->title('Cabin')->addClass('text-nowrap text-center align-middle'),

            Column::make('booking_from')->addClass('text-nowrap text-center align-middle'),
            Column::make('booking_to')->addClass('text-nowrap text-center align-middle'),

            Column::make('check_in_date')->addClass('text-nowrap text-center align-middle'),
            Column::make('check_out_date')->addClass('text-nowrap text-center align-middle'),

            Column::make('booking_source.name')->title('Booking Source')->addClass('text-nowrap text-center align-middle'),

            Column::make('created_at')->addClass('text-nowrap text-center align-middle'),
            Column::make('updated_at')->addClass('text-nowrap text-center align-middle'),
            Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle'),
        ];
        return $columns;
    }
}
