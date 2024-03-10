<?php

namespace App\DataTables;

use App\Models\MeterReading;
use App\Utils\Traits\DataTableTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MeterReadingsDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('check', function ($meterReading) {
                return $meterReading;
            })
            ->editColumn('reading', function ($meterReading) {
                return $meterReading->reading . match ($meterReading->meter_type->value) {
                    'electric' => ' kWh',
                    'gas' => ' M<sup>3</sup>',
                    'water' => ' M<sup>3</sup>',
                    default => ''
                };
            })
            ->editColumn('meter_type', function ($meterReading) {
                return editTitleColumn($meterReading->meter_type);
            })
            ->editColumn('comments', function ($meterReading) {
                return $meterReading->comments ?? '-';
            })
            ->editColumn('reading_date', function ($meterReading) {
                return editDateTimeColumn($meterReading->reading_date);
            })
            ->editColumn('updated_at', function ($meterReading) {
                return editDateTimeColumn($meterReading->updated_at);
            })
            ->editColumn('actions', function ($meterReading) {
                return view('meter-readings.actions', ['meterReading' => $meterReading]);
            })
            ->rawColumns($columns);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MeterReading $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MeterReading $model): QueryBuilder
    {
        return $model->newQuery()->select('meter_readings.*')->with(['cabin']);
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        if (auth()->user()->can('meter-readings.create')) {
            $buttons[] = Button::raw('add-new')
                ->addClass('btn btn-primary waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add New')
                ->attr([
                    'onclick' => 'addNew()',
                ]);
        }

        if (auth()->user()->can('meter-readings.export')) {
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

        if (auth()->user()->can('meter-readings.destroy')) {
            $buttons[] = Button::raw('delete-selected')
                ->addClass('btn btn-danger waves-effect waves-float waves-light m-1')
                ->text('<i class="fa-solid fa-minus"></i>&nbsp;&nbsp;Delete Selected')
                ->attr([
                    'onclick' => 'deleteSelected()',
                ]);
        }

        return $this->builder()
            ->setTableId('meter-readings-table')
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
            ->fixedColumns([
                'left' => 0,
                'right' => 1,
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

        if (auth()->user()->can('meter-readings.destroy')) {
            $checkColumn->addClass('disabled');
        }

        $columns = [
            $checkColumn,

            Column::make('cabin.name')->title('Cabin')->addClass('text-nowrap text-center align-middle'),
            Column::make('reading')->addClass('text-nowrap text-center align-middle'),
            Column::make('reading_date')->addClass('text-nowrap text-center align-middle'),
            Column::make('meter_type')->title('Meter')->addClass('text-nowrap text-center align-middle'),
            Column::make('comments')->width(160)->addClass('text-nowrap text-center align-middle'),
            Column::make('updated_at')->addClass('text-nowrap text-center align-middle'),
            Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-nowrap text-center align-middle'),
        ];
        return $columns;
    }
}
