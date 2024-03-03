<?php

namespace App\DataTables;

use App\Models\Cabin;
use App\Services\Bookings\BookingInterface;
use App\Utils\Enums\CabinStatus;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
            ->editColumn('cabin_status', function ($model) {
                return Str::of($model->cabin_status->name)->replace('_', " ")->title();
            })
            ->editColumn('long_term', function ($model) {
                return editStatusColumn($model->long_term);
            })
            ->editColumn('utilities', function ($model) {
                return "<span class='badge bg-" . ($model->electric_meter ? "success" : "danger") . " bg-glow me-1'>E</span><span class='badge bg-" . ($model->gas_meter ? "success" : "danger") . " bg-glow me-1'>G</span><span class='badge bg-" . ($model->water_meter ? "success" : "danger") . " bg-glow me-1'>W</span>";
            })
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
        $bookingFrom = $this->booking_from;
        $bookings = $this->bookingInterface->getBookedCabinsWithinDates($bookingFrom, $this->booking_to)->toArray();
        $bookingCabinIds = array_column($bookings, 'cabin_id');

        $cabins = $model->newQuery()
            ->select('cabins.*')
            ->with(['cabin_type'])
            ->where(function ($query) use ($bookingFrom) {
                $query->where('cabins.cabin_status', CabinStatus::VACANT)
                    ->orWhere(function ($query) use ($bookingFrom) {
                        $query->where('cabins.cabin_status', CabinStatus::CLOSED_TEMPORARILY)
                            ->where('cabins.closed_to', '<', $bookingFrom->timestamp);
                    });
            });

        if (count($bookingCabinIds) > 0) {
            $cabins->whereNotIn('cabins.id', $bookingCabinIds);
        }

        // $cabins->ddRawSql();

        return $cabins;
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

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
            ->stateSave()
            ->processing()
            ->deferRender()
            
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"d-flex justify-content-between mx-0 pb-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->scrollX()
            ->pagingType('full_numbers')
            ->lengthMenu([
                [30, 50, 70, 100, 120, 150, -1],
                [30, 50, 70, 100, 120, 150, "All"],
            ])
            ->buttons($buttons)
            ->fixedColumns([
                'right' => 1,
            ])
            // ->rowGroupDataSrc('parent_id')
            ->orders([
                [2, 'asc'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $columns = [
            Column::computed('DT_RowIndex')->title('#'),
            Column::make('name')->addClass('text-nowrap text-center align-middle'),
            Column::make('cabin_status')->title('Cabin Status')->addClass('text-nowrap text-center align-middle'),
            Column::make('cabin_type.name')->title('Cabin Type')->addClass('text-nowrap text-center align-middle'),
            Column::make('long_term')->addClass('text-nowrap text-center align-middle'),
            Column::computed('utilities')->addClass('text-nowrap text-center align-middle'),
            Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle'),
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
