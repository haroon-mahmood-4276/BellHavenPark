@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'cabins.index') }}
@endsection

@section('page-title', 'Cabins')

@section('page-vendor')
    @include('layout.libs.datatables.css')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Cabins (Maintenance)</h2>
        {{ Breadcrumbs::render('cabins.index') }}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="get" id="form_maintenance_cabins_list">
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modalPlace"></div>
@endsection

@section('vendor-js')
    @include('layout.libs.datatables.js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        function addCabinToMaintenance() {
            $.ajax({
                url: ("{{ route('ajax.cabins.modal.maintenance.add') }}"),
                type: 'GET',
                cache: false,
                beforeSend: function() {
                    showBlockUI();
                },
                success: function(response) {
                    if (response.status) {
                        $('#' + response.data.modalPlace).html(response.data.modal);
                        $('#' + response.data.currentModal).modal('show');
                        hideBlockUI();
                    }
                },
                error: function(jqXhr, json, errorThrown) {
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';

                    $.each(errors['errors'], function(index, value) {
                        errorsHtml += "<span class='badge rounded-pill bg-danger p-3 m-3'>" + index +
                            " -> " + value + "</span>";
                    });
                },
                complete: function() {
                    hideBlockUI();
                },
            });
        }

        function removeFromMaintenance() {
            let data = []
            $('#maintenance-cabins-table input[id^="checkForDelete_"]:checked').each(function(element) {
                data.push(parseInt($(this).attr('id').replace('checkForDelete_', '')))
            })

            if (data.length > 0) {
                $.ajax({
                    url: ("{{ route('ajax.cabins.modal.maintenance.remove') }}"),
                    type: 'GET',
                    cache: false,
                    data: {
                        cabins: data
                    },
                    beforeSend: function() {
                        showBlockUI();
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#' + response.data.modalPlace).html(response.data.modal);
                            $('#' + response.data.currentModal).modal('show');
                            hideBlockUI();
                        }
                    },
                    error: function(jqXhr, json, errorThrown) {
                        var errors = jqXhr.responseJSON;
                        var errorsHtml = '';

                        $.each(errors['errors'], function(index, value) {
                            errorsHtml += "<span class='badge rounded-pill bg-danger p-3 m-3'>" +
                                index +
                                " -> " + value + "</span>";
                        });
                    },
                    complete: function() {
                        hideBlockUI();
                    },
                });
            }
        }
    </script>
@endsection
