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
                data.seller_id  = 0;

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
            function renderSeller(id, seller_id) {
                var temp    = '';
                temp        += '<select class="form-control select-seller" data-id="'+id+'">';
                temp        += '<option value="" '+(seller_id == 0 ? 'selected' : '')+'></option>';
                $.each(seller, function (index, el) {
                    temp    += '<option value="'+el.id+'" '+(seller_id == el.id ? 'selected': '')+'>'+el.name+'</option>';
                });
                temp        += '</select>';

                return temp;
            }

            var tableHolder = $("#table-render");
            function renderTable() {
                var temp    = '';
                $.each(list, function (index, el) {
                    temp    += '<tr>';
                    temp    += '<td>'+(index+1)+'</td>';
                    temp    += '<td>'+el.name+' ('+el.phone_number+')'+'<br />'+el.address+'</td>';
                    temp    += '<td width="250">'+renderSeller(el.id, el.seller_id)+'</td>';
                    temp    += '<td><button class="btn btn-danger remove-list" data-id="'+el.id+'"><i class="far fa-times"></i></button></td>';
                    temp    += '</tr>';
                });

                tableHolder.html(temp);
            }


            $("body").on('change', '.select-seller', function () {
                var id  = $(this).data('id');
                var value   = $(this).val();

                var index   = list.findIndex(function (el) {
                    return el.id == id;
                });

                list[index].seller_id   = value;

                return false;
            });

            $("body").on('click', '.remove-list', function (e) {
                var id  = $(this).data('id');
                var index   = list.findIndex(function (el) {
                    return el.id == id;
                });

                list.splice(index, 1);
                renderTable();

                $("#select-customer").select2("val", "");
                console.log('asdf');
            });

            var targetPrintAddress  = '{{ route('admin_do_print_address') }}';
            var targetSaveAddress   = '{{ route('admin_do_save_request_print') }}';
            var formHolder  = $("#form-holder");

            $(".btn-print").click(function () {
                var data    = collectData();

                $("#data-holder").val(data);
                formHolder.attr('action', targetPrintAddress);
                bootbox.confirm('Are you sure to print?', function (result) {
                    if(result) {
                        formHolder.submit();
                    }
                })
            });

            $(".btn-save-request").click(function () {
                var data    = collectData();

                $("#data-holder").val(data);
                formHolder.attr('action', targetSaveAddress);
                bootbox.confirm('Are you sure want to request print?', function (result) {
                    if(result) {
                        formHolder.submit();
                    }
                })
            });

            function collectData() {
                var data    = [];
                $.each(list, function (index, el) {
                    data.push(el.id+':'+el.seller_id);
                });
                data    = data.join(';');
                return data;
            }

        });
    </script>
@stop

@section('menu')
    <button type="button" class="btn btn-warning btn-print"><i class="far fa-print"></i> Print!</button>
    <button type="button" class="btn btn-dark btn-save-request"><i class="far fa-save"></i> Request!</button>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="stick">
                <select class="js-example-basic-multiple js-states form-control" id="select-customer"></select>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table" id="table-render">

                </table>
            </div>
        </div>
    </div>
    <form id="form-holder" class="hidden" method="post" action="{{ route('admin_do_print_address') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="data" id="data-holder" value="">
    </form>
@stop
