<?php

namespace App\DataTables;

use App\Models\Booking;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingsDataTable extends DataTable
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

            ->editColumn('created_at', function ($booking) {
                return editDateColumn($booking->created_at);
            })
            ->editColumn('updated_at', function ($booking) {
                return editDateColumn($booking->updated_at);
            })
            ->editColumn('actions', function ($booking) {
                return view('bookings.actions', ['id' => $booking->id]);
            })
            ->editColumn('check', function ($booking) {
                return $booking;
            })
            ->setRowId('id')
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
        return $model->newQuery()->with(['customer']);
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
            ->dom('BlfrtipC')
            ->scrollX()
            ->pagingType('full_numbers')
            ->lengthMenu([
                [30, 50, 70, 100, 120, 150, -1],
                [30, 50, 70, 100, 120, 150, "All"],
            ])
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            // ->rowGroupDataSrc('parent_id')
            ->columnDefs([
                [
                    'targets' => 0,
                    'className' => 'text-center text-primary',
                    'width' => '10%',
                    'orderable' => false,
                    'searchable' => false,
                    'responsivePriority' => 3,
                    'render' => "function (data, type, full, setting) {
                        var role = JSON.parse(data);
                        return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"checkForDelete[]\" id=\"checkForDelete_' + role.id + '\" /><label class=\"form-check-label\" for=\"chkRole_' + role.id + '\"></label></div>';
                    }",
                    'checkboxes' => [
                        'selectAllRender' =>  '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
                    ]
                ],
            ])
            ->orders([
                [3, 'asc'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $checkColumn = Column::computed('check')->exportable(false)->printable(false)->width(60)->addClass('text-nowarp');

        if (auth()->user()->can('bookings.destroy')) {
            $checkColumn->addClass('disabled');
        }

        $columns = [
            $checkColumn,
            Column::make('booking_number')->title('ID')->addClass('text-nowarp'),
            Column::make('customer.name')->addClass('text-nowarp'),
            Column::make('created_at')->addClass('text-nowarp'),
            Column::make('updated_at')->addClass('text-nowarp'),
            Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-center text-nowrap'),
        ];
        return $columns;
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
