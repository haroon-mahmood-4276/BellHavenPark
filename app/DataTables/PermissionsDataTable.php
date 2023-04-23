<?php

namespace App\DataTables;

use App\Models\{Role, Permission};
use Yajra\DataTables\Html\{Button, Column};
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;

class PermissionsDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('roles', function ($permission) {
                return [
                    'permission_id' => $permission->id,
                    'roles' => $permission->roles->pluck('id')->toArray()
                ];
            })
            ->editColumn('created_at', function ($permission) {
                return editDateColumn($permission->created_at);
            })
            ->editColumn('updated_at', function ($permission) {
                return editDateColumn($permission->updated_at);
            })
            ->setRowId('id')
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Spatie\Permission\Models\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model): QueryBuilder
    {
        return $model->newQuery()->with('roles');
        // if (auth()->user()->can('permissions.view_all')) {
        // } else {
        //     $CurrentUserRole = auth()->user()->roles->pluck('id');
        //     return (new Role())->where('id', $CurrentUserRole[0])->with('permissions')->first()->permissions->toQuery();
        // }
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        // if (auth()->user()->can('admin.permissions.create')) {
        //     $buttons[] = Button::raw('delete-selected')
        //         ->addClass('btn btn-primary waves-effect waves-float waves-light m-1')
        //         ->text('<i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add New')
        //         ->attr([
        //             'onclick' => 'addNew()',
        //         ]);
        // }

        if (auth()->user()->can('admin.permissions.export')) {
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

        if (auth()->user()->can('admin.permissions.destroy')) {
            $buttons[] = Button::raw('delete-selected')
                ->addClass('btn btn-danger waves-effect waves-float waves-light m-1')
                ->text('<i class="icon material-icons md-delete"></i><span id="delete_selected_count" style="display:none">0</span> Delete Selected')
                ->attr([
                    'onclick' => 'deleteSelected()',
                ]);
        }

        return $this->builder()
            ->setTableId('permissions-table')
            ->addTableClass('table-borderless table-striped table-hover class-datatable-for-event')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->stateSave()
            ->serverSide()
            ->processing()
            ->deferRender()
            ->dom('BlfrtipC')
            ->pagingType('full_numbers')
            ->lengthMenu([
                [30, 50, 70, 100, 120, 150, -1],
                [30, 50, 70, 100, 120, 150, "All"],
            ])
            ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            ->rowGroupDataSrc('class')
            ->scrollX()
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
        $currentAuthRoles = auth()->user()->roles;
        $roles = getLinkedTreeData(new Role(), $currentAuthRoles->pluck('id'));
        $roles = array_merge($currentAuthRoles->toArray(), $roles); // Add current role to the list
        unset($roles[0]['pivot']);

        $colArray = [
            Column::computed('DT_RowIndex')->title('#'),
            Column::make('show_name')->title('Permission Name')->addClass('text-nowrap')->ucfirst(),
        ];

        foreach ($roles as $key => $role) {

            $colArray[] = Column::computed('roles')
                ->title($role['name'])
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->render('function () {
                    var roles = data.roles;
                    var isPermissionAssigned = roles.includes("' . $role['id'] . '");
                    var checkbox = "<div class=\'form-check d-flex justify-content-center\'>";

                    if(isPermissionAssigned) {
                        checkbox += "<input class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(\"' . $role['id'] . '\", \"" + data.permission_id + "\")\'  id=\'chkRolePermission_' . $role['id']  . '__' . '" + data.permission_id + "\' checked />";
                    } else {
                        checkbox += "<input class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(\"' . $role['id'] . '\", \"" + data.permission_id + "\")\'  id=\'chkRolePermission_' . $role['id']  . '__' . '" + data.permission_id + "\' />";
                    }
                    checkbox += "<label class=\'form-check-label\' for=\'chkRolePermission_' . $role['id']  . '__' . '" + data.permission_id + "\'></label></div>";
                    return checkbox;
                }');
        }

        // $colArray[] = Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-center');
        return $colArray;
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Permissions_' . date('YmdHis');
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
