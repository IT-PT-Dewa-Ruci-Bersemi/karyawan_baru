<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 23/08/20
 * Time: 18.25
 */
?>
@extends("admin::templates.master")

@section('menu')
    <a href="{{ route('admin_print_request_list') }}" class="btn btn-warning" title="Print Request"><i class="far fa-print-search"></i> Print Request</a>
    <a href="{{ route('admin_print_address') }}" class="btn btn-info" title="Print"><i class="far fa-print"></i>Print</a>
@stop

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Name',width:2,data:'name', align:'left',sort:true},
                {head:'IG',width:2,data:'instagram_name', align:'left',sort:true},
                {head:'Phone Number',width:2,data:'phone_number', align:'left',sort:true},
                {head:'Address',width:4,data:'address', align:'left',sort:true},
            ];

            var filter  = [
                {data:'name',type:'text'},
                {data:'instagram_name',type:'text'},
                {data:'phone_number',type:'text'},
                {data:'address',type:'text'},
            ];

            var button  = {
                add:[{
                    name:'instagram_name',
                    label:'IG Name',
                    type:'text',
                    placeholder:'Input Instagram Name'
                },{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Name'
                }, {
                    name:'phone_number',
                    label:'Phone',
                    type:'text',
                    required:true,
                    placeholder:'Phone Number'
                }, {
                    name:'address',
                    label:'Address',
                    type:'textarea',
                    placeholder:'Address'
                }],
                edit:[{
                    name:'instagram_name',
                    label:'IG Name',
                    type:'text',
                    placeholder:'Input Instagram Name'
                },{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Name'
                }, {
                    name:'phone_number',
                    label:'Phone',
                    type:'text',
                    required:true,
                    placeholder:'Phone Number'
                }, {
                    name:'address',
                    label:'Address',
                    type:'textarea',
                    placeholder:'Address'
                }]
            };


            i_form.initGrid({
                number: true,
                header: header,
                filter: filter,
                button: button,
                sort: {{ $menu_default_sort }},
                data: {!! json_encode($records->toArray()) !!},
                pagination: '{!! $pagination !!}',
                menu_action: {!! json_encode($menu_action) !!}
            },$("#grid"));
        });
    </script>
@stop

