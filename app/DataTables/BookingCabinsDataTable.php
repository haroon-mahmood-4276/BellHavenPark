<?php

namespace App\DataTables;

use App\Models\Cabin;
use App\Services\Bookings\BookingInterface;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingCabinsDataTable extends DataTable
{

    private $bookingInterface;

    public function __construct(BookingInterface $bookingInterface)
    {
        $this->bookingInterface = $bookingInterface;
    }

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
            ->addIndexColumn()
            ->editColumn('updated_at', function ($cabin) {
                return editDateTimeColumn($cabin->updated_at);
            })
            ->editColumn('actions', function ($cabin) {
                return view('bookings.cabins.actions', ['id' => $cabin->id]);
            })
            ->setRowId('id')
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Cabin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cabin $model): QueryBuilder
    {
        $bookings = $this->bookingInterface->getBookedCabinsWithinDates($this->booking_from, $this->booking_to)->toArray();
        $bookings = array_column($bookings, 'cabin_id');

        $cabins = $model->newQuery()
            ->select('cabins.*')
            ->with(['cabin_type', 'cabin_status'])
            ->whereNotIn('cabins.id', $bookings);

        return $cabins;
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
            ->dom('<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            ->fixedColumns([
                'right' => 1,
            ]);
            // ->rowGroupDataSrc('parent_id')
            // ->orders([
            //     [3, 'asc'],
            // ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $columns = [
            Column::computed('DT_RowIndex')->title('#')->orderable(false),
            Column::make('name')->addClass('text-nowrap text-center align-middle')->orderable(false),
            Column::make('cabin_status.name')->title('Cabin Status')->addClass('text-nowrap text-center align-middle')->orderable(false),
            Column::make('cabin_type.name')->title('Cabin Type')->addClass('text-nowrap text-center align-middle')->orderable(false),
            Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle')->orderable(false),
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
        return 'BookingCabins_' . date('YmdHis');
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
