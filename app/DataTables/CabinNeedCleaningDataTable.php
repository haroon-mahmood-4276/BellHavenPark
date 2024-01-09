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
            ->editColumn('long_term', function ($model) {
                return editStatusColumn($model->long_term);
            })
            ->editColumn('utilities', function ($model) {
                return "<span class='badge bg-" . ($model->electric_meter ? "success" : "danger") . " bg-glow me-1'>E</span><span class='badge bg-" . ($model->gas_meter ? "success" : "danger") . " bg-glow me-1'>G</span><span class='badge bg-" . ($model->water_meter ? "success" : "danger") . " bg-glow me-1'>W</span>";
            })
            ->editColumn('cabin_status', function ($model) {
                return editCabinStatusColumn($model->cabin_status->value);
            })
            ->editColumn('updated_at', function ($model) {
                return editDateTimeColumn($model->updated_at);
            })
            ->setRowId('id')
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    public function query(Cabin $model): QueryBuilder
    {
        return $model->newQuery()->select('cabins.*')->with(['cabin_type'])->where('cabin_status', CabinStatus::NEEDS_CLEANING);
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('cabins.create')) {
            $buttons[] = Button::raw('add-new')
                ->addClass('btn btn-primary waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add to cleaning')
                ->attr([
                    'onclick' => 'addCabinToNeedsCleaning()',
                ]);
        }

        if (auth()->user()->can('cabins.destroy')) {
            $buttons[] = Button::raw('delete-selected')
                ->addClass('btn btn-danger waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-minus"></i>&nbsp;&nbsp;Remove from cleaning')
                ->attr([
                    'onclick' => 'removeFromNeedsCleaning()',
                ]);
        }

        $buttons = array_merge($buttons, [
            Button::make('reset')->addClass('btn btn-danger waves-effect waves-float waves-light m-1'),
            Button::make('reload')->addClass('btn btn-primary waves-effect waves-float waves-light m-1'),
        ]);

        return $this->builder()
            ->setTableId('needs-cleaning-cabins-table')
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
                        var role = JSON.parse(data);
                        return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"checkForDelete[]\" id=\"checkForDelete_' + role.id + '\" /><label class=\"form-check-label\" for=\"chkRole_' + role.id + '\"></label></div>';
                    }",
                    'checkboxes' => [
                        'selectAllRender' =>  '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
                    ]
                ],
            ])
            ->orders([
                [6, 'desc'],
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

        if (auth()->user()->can('cabins.destroy')) {
            $checkColumn->addClass('disabled');
        }

        $columns = [
            $checkColumn,
            Column::make('name')->addClass('text-nowrap text-center align-middle'),
            Column::make('cabin_status')->title('Status')->addClass('text-nowrap text-center align-middle'),
            Column::make('cabin_type.name')->title('Type')->addClass('text-nowrap text-center align-middle'),
            Column::make('long_term')->addClass('text-nowrap text-center align-middle'),
            Column::computed('utilities')->addClass('text-nowrap text-center align-middle'),
            Column::make('updated_at')->addClass('text-nowrap text-center align-middle'),
        ];
        return $columns;
    }
}
