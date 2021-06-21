<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 16/11/20
 * Time: 09.22
 */
?>
@extends('admin::templates.master')

@section('style')
    <style>
        .table-sm.table-bordered * {
            border-color: gray!important;
        }
        .select-shipper {
            min-width: 150px;
        }
        @media only screen and (max-device-width: 480px) {
            .select-shipper {
                width: 200px;
            }
        }
    </style>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var _token      = '{{ csrf_token() }}';
            var headerID    = '{{ $header->id }}';
            $(".edit-qty").on('click', function () {
                var $target = $(this).data('target');
                $("#qty-form-"+$target).removeClass('d-none');
                $("#qty-holder-"+$target).addClass('d-none');
                $("#input-qty-"+$target).select();
            });
            $(".qty-form").on('submit', function (el) {
                //jquery here to save.
                var $target = $(this).data('target');

                $("#qty-form-"+$target).addClass('d-none');
                $("#qty-holder-"+$target).removeClass('d-none');
                var value   = $("#input-qty-"+$target).val();
                var data    = {
                    '_token': _token,
                    'target': $target,
                    'value': value,
                    'header': headerID
                };

                loading.show();
                $.post('{{ route('admin_api_transaction_detail_update_qty') }}', data, function (response) {
                    loading.hide();
                    if(response.status) {
                        var $val    = response.others.value;
                        $("#input-qty-"+$target).val($val);
                        $("#qty-"+$target).html($val);
                    } else {
                        bootbox.alert(response.message);
                    }
                });

                el.preventDefault();
                return false;
            });

            $(".view-shipment-manifest").on('click', function (e) {
                var $target = $(this).data('target');
                var data    = {
                    header: headerID,
                    detail: $target
                }

                loading.show();
                $.get('{{ route('admin_api_get_transaction_detail_ship_manifest') }}', data, function (response) {
                    if(response.status) {
                        $("#ship-manifest").find('.modal-body').html(response.others);
                        $("#ship-manifest").modal('show');
                    } else {
                        bootbox.alert(response.message);
                    }
                    loading.hide();
                });

                e.preventDefault();
                return false;
            });
            $('#ship-manifest').on('hidden.bs.modal', function () {
                $(this).find('.modal-body').html('');
            });

            $("body").on('click', '.revert-status', function (e) {
                var $target = $(this).data('target');
                bootbox.confirm("Are you sure want to reverse the status?", function (result) {
                    if(result) {
                        var $data   = {
                            _token: _token,
                            id: $target,
                            header: headerID
                        };
                        loading.show();
                        $.post('{{ route('admin_api_transaction_detail_revert') }}', $data, function (response) {
                            loading.hide();
                            if(response.status) {
                                var $render = response.others;

                                $("#badge-holder-"+$target).html($render);
                            } else {
                                 bootbox.alert(response.message);
                            }
                        });
                    }
                });

                e.preventDefault();
                return false;
            });

            var loading = $(".loading");
            $("body").on('click', ".btn-update-status", function () {
                var $target = $(this).data('target');
                var $status = $(this).data('status');

                loading.show();
                bootbox.confirm("are you sure want to update this transaction status?", function(status) {
                    if(status) {
                        var $data   = {
                            _token: _token,
                            id: $target,
                            header: headerID
                        };
                        if($status == 4) {
                            var $shipper    = $("#select-shipper-"+$target).val();
                            var $trackingCode   = $("#input-shipment-code-"+$target).val();

                            if($shipper == "" || $trackingCode == "") {
                                bootbox.alert('Oops, you need to select the shipper and input the tracking code.');
                                loading.hide();
                                return;
                            }
                            $data.shipper    = $shipper;
                            $data.tracking_code = $trackingCode;
                        }

                        $.post('{{ route('admin_api_transaction_detail_update') }}', $data, function (response) {
                            loading.hide();
                            if(response.status) {
                                var $render = response.others;

                                $("#badge-holder-"+$target).html($render);
                            } else {
                                bootbox.alert(response.message);
                            }
                        });
                    } else {
                        loading.hide();
                    }
                });

            });
        });
    </script>
@stop

@section('menu')
    <a class="btn btn-info" target="_blank" href="{{ route('admin_transaction_print_header', $header->id) }}" data-toggle="tooltip" title="Print"><i class="far fa-print"></i> Print</a>
    <a class="btn btn-info" href="{{ route('admin_transaction_update_form', $header->id) }}"><i class="far fa-plus-circle"></i> Add</a>
@stop

@section('content')
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-white">
            <tr align="center">
                <th rowspan="2" width="10" class="align-middle">No</th>
                <th rowspan="2" width="50" class="align-middle">Customer</th>
                <th rowspan="2" width="30" class="align-middle">Status</th>
                <th width="50" rowspan="2" class="align-middle">Qty</th>
                <th colspan="4">Price</th>
            </tr>
            <tr align="center">
                <th width="100">Total</th>
                <th width="100">Ship</th>
                <th width="100">Pack</th>
                <th width="100">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $index=>$l)
                <tr>
                    <td rowspan="2" class="text-center">{{ $index+1 }}</td>
                    <td rowspan="2">
                        <b>{{ $l->customer_name }}</b>({{ $l->customer_phone }})<br/>
                        {{ $l->customer_address }}
                    </td>
                    <td align="center" class="align-middle" id="badge-holder-{{ $l->id }}">
                        @include('admin::transaction.widget.transaction_detail_status')
                    </td>
                    <td align="center" class="align-middle" rowspan="2">
                        <div class="qty-holder" id="qty-holder-{{$l->id}}">
                            <span id="qty-{{ $l->id }}">{{ $l->qty }}</span>
                            <a class="edit-qty" data-target="{{ $l->id }}" href="#" data-toggle="tooltip" title="Edit Qty"><i class="far fa-pencil"></i></a>
                        </div>
                        <form class="qty-form d-none" id="qty-form-{{$l->id}}" data-target="{{ $l->id }}">
                            <div class="input-group">
                                <input type="number" class="form-control input-qty" data-id="{{ $l->id }}" id="input-qty-{{ $l->id }}" value="{{ $l->qty }}" />
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-success"><i class="far fa-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                </tr>
                <tr>
                    <td class="text-center">
                        <h6>Action</h6>
                        <small>
                            @if($l->status_id != 6 && $l->status_id > 2)
                            <a href="#" class="badge badge-warning revert-status" data-target="{{ $l->id }}" data-toogle="tooltip" title="Revert Status"><i class="far fa-history"></i></a>
                            @endif
                            <a class="badge badge-info" href="{{ route('admin_transaction_detail_status_log', [$header->id, $l->id]) }}" target="_blank" data-toggle="tooltip" title="View Status Log"><i class="far fa-file-alt"></i></a>
                            &nbsp;
                            @if($l->status_id >= 5)
                                <a href="#" class="badge badge-primary view-shipment-manifest" data-target="{{ $l->id }}" data-toggle="tooltip" title="Shipment History"><i class="far fa-shipping-timed"></i></a>
                            @endif
                        </small>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('modal_holder')
    <div class="modal fade" id="ship-manifest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ship Manifest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop