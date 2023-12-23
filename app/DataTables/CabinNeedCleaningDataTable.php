<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\Cabin;
use App\Utils\Enums\CabinStatus;
use App\Utils\Traits\DataTableTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CabinNeedCleaningDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->editColumn('check', function ($model) {
                return $model;
            })
            ->editColumn('cabin_status', function ($model) {
                return editCabinStatusColumn($model->cabin_status->value);
            })
            ->editColumn('updated_at', function ($model) {
                return editDateTimeColumn($model->updated_at);
            })
            ->editColumn('actions', function ($model) {
                return view('cabins.needs-cleaning.actions', ['id' => $model->id]);
            })
            ->setRowId('id')
            ->rawColumns($columns);
    }

    public function query(Cabin $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('cabins.*')
            ->where('cabin_status', CabinStatus::NEEDS_CLEANING)
            ->orWhereIn('id', Booking::whereBetween('booking_to', [now()->startOfDay()->timestamp, now()->endOfDay()->timestamp])->pluck('cabin_id')->toArray())
            ->with(['cabin_type']);
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('cabins.needs-cleaning.update')) {
            $buttons[] = Button::raw('update-for-checkin-cabins')
                ->addClass('btn btn-primary waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-check"></i>&nbsp;&nbsp; Available for check in')
                ->attr([
                    'onclick' => 'updateForCheckInCabins()',
                ]);
        }

        $buttons = array_merge($buttons, [
            Button::make('reset')->addClass('btn btn-danger waves-effect waves-float waves-light m-1'),
            Button::make('reload')->addClass('btn btn-primary waves-effect waves-float waves-light m-1'),
        ]);

        return $this->builder()
            ->setTableId('cabins-table')
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
            ->columnDefs([
                [
                    'targets' => 0,
                    'className' => 'text-center text-primary',
                    'width' => '10%',
                    'orderable' => false,
                    'searchable' => false,
                    'responsivePriority' => 3,
                    'render' => "function (data, type, full, setting) {
                        data = JSON.parse(data);
                        if('needs_cleaning' === data.cabin_status) {
                            return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + data.id + '\" name=\"checkForUpdate[]\" id=\"checkForUpdate_' + data.id + '\" /><label class=\"form-check-label\" for=\"chkRole_' + data.id + '\"></label></div>';
                        } 
                        return 'Available <br> on checkout';
                    }",
                    'checkboxes' => [
                        'selectAllRender' =>  '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
                    ]
                ],
            ])
            ->orders([
                [3, 'desc'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $checkColumn = Column::computed('check')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle ');

        if (auth()->user()->can('cabins.destroy')) {
            $checkColumn->addClass('disabled');
        }

        $columns = [
            $checkColumn,
            Column::make('name')->addClass('text-nowrap text-center align-middle'),
            Column::make('cabin_status')->title('Status')->addClass('text-nowrap text-center align-middle'),
            Column::make('updated_at')->addClass('text-nowrap text-center align-middle'),
        ];
        return $columns;
    }
}
