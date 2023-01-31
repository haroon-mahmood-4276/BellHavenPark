@extends('admin.app.layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'admin.permissions.index') }}
@endsection

@section('page-title', __('lang.permissions.permission_plural'))

@section('page-vendor')
    {{ view('admin.app.layout.datatables.css') }}
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Permissions</h2>
        {{ Breadcrumbs::render('admin.permissions.index') }}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="javascript:void(0);" id="permissions-table-form" method="get">
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    {{ view('admin.app.layout.datatables.js') }}
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ __('lang.commons.are_you_sure_you_want_to_delete_the_selected_items') }}',
                    showCancelButton: true,
                    cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
                    confirmButtonText: '{{ __('lang.commons.yes_delete') }}',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#permissions-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ __('lang.commons.please_select_at_least_one_item') }}',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                });
            }
        }

        function changeRolePermission(role_id, permission_id) {

            var checkBoxState = $('#chkRolePermission_' + role_id + '_' + permission_id).is(':checked');

            var url = "";
            if (checkBoxState) {
                url = '{{ route('admin.permissions.assign-permission') }}';
            } else {
                url = '{{ route('admin.permissions.revoke-permission') }}';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    role_id: role_id,
                    permission_id: permission_id,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        toastr.success(response.message,
                            "Success!", {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 2e3,
                                closeButton: !0,
                                tapToDismiss: !1,
                            });
                        $('#permissions-table').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });
        }
    </script>
@endsection
