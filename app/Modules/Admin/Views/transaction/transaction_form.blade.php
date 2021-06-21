<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 23/08/20
 * Time: 22.38
 */
?>
@extends('admin::templates.master')
@section('style')
    <style>
        #table-render tr:not(:last-child) td{
            border-bottom: 1px solid black!important;
        }
    </style>
@stop
@section('scripts')
    {!! \App\Modules\Libraries\Plugin::get('select2') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            var list    = [];

            var apiURL = '{{ route('admin_api_get_customer_address') }}';
            $('#select-customer').select2({

                ajax: {
                    url: apiURL,
                    dataType: 'json',
                    processResults: function (data, params) {
                        return {
                            results: $.map(data.message, function(obj) {
                                return {
                                    id: obj.id,
                                    ig_name:obj.instagram_name,
                                    name:obj.name,
                                    address:obj.address,
                                    phone_number: obj.phone_number
                                };
                            })
                        };
                    },
                },
                placeholder: "Select customer",
                minimumInputLength: 2,
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: template,
            }).on("select2:selecting", function(e) {
                var data = e.params.args.data;

                list.push(data);
                renderTable();
                $("#select-customer").select2("val", "");
            });

            function template(data, raw) {
                if (!data.id) {
                    return data.text;
                }
                return '<b>('+data.ig_name+')</b> '+data.name +' '+ data.phone_number +'<br />'+data.address;
            }

            var seller  = $.parseJSON('{!! json_encode($seller) !!}');


            function renderSeller() {
                return seller['name']+'<br />'+seller['phone_number'];
            }

            var tableHolder = $("#table-render>tbody");
            function renderTable() {
                var temp    = '';
                $.each(list, function (index, el) {
                    temp    += '<tr>';
                    temp    += '<td>'+(index+1)+'</td>';
                    temp    += '<td>'+el.name+' ('+el.phone_number+')'+'<br />'+el.address+'</td>';
                    temp    += '<td width="250">'+renderSeller()+'</td>';
                    temp    += '<td><button class="btn btn-danger remove-list" data-id="'+el.id+'"><i class="far fa-times"></i></button></td>';
                    temp    += '</tr>';
                });

                tableHolder.html(temp);
            }

            $("body").on('click', '.remove-list', function (e) {
                var id  = $(this).data('id');
                var index   = list.findIndex(function (el) {
                    return el.id == id;
                });

                list.splice(index, 1);
                renderTable();

                $("#select-customer").select2("val", "");
            });

            function collectData() {
                var data    = [];
                $.each(list, function (index, el) {
                    data.push(el.id);
                });
                data    = data.join(';');
                return data;
            }

            @if($edit)
            var targetCheckout  = '{{ route('admin_transaction_do_update_form', $header_transaction->id) }}';
            @else
            var targetCheckout  = '{{ route('admin_transaction_checkout') }}';
            @endif

            var formHolder  = $("#form-holder");

            $(".btn-checkout").click(function () {
                var data    = collectData();

                $("#data-holder").val(data);
                formHolder.attr('action', targetCheckout);
                bootbox.confirm('Are you sure to print?', function (result) {
                    if(result) {
                        formHolder.submit();
                    }
                })
            });
        });
    </script>
@stop

@section('menu')
    <button type="button" class="btn btn-outline-success btn-checkout" data-toggle="tooltip" title="{{ $edit ? "Add Customer" : "Check out" }}"><i class="far {{ $edit ? "fa-plus" : "fa-shopping-cart" }}"></i> {{ $edit ? "Add Customer" : "Check out" }}</button>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="stick">
                <select class="js-example-basic-multiple js-states form-control" id="select-customer"></select>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="table-render">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Customer</th>
                            <th>Sender</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <form id="form-holder" class="hidden" method="post" action="{{ route('admin_do_print_address') }}">
        {!! csrf_field() !!}
        @if($edit)
            <input type="hidden" name="target" value="{{ $header_transaction->id }}" />
        @endif
        <input type="hidden" name="data" id="data-holder" value="">
    </form>
@stop
