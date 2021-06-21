<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 28/09/20
 * Time: 23.37
 */
?>
@extends('admin::templates.master')

@section('menu')
    <a href="{{ route('admin_print_address') }}" class="btn btn-primary"><i class="far fa-print"></i> Add Print Request</a>
@stop

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Requester',data:'admin_id',width:2,belongsTo:['admin','name'], align:'left',sort:true,type:'relation'},
                {head:'Last Update',width:"2",data:'updated_at',align:'left',type:'custom',sort:true,render:function (records, value) {
                        if(!value) return '';
                        var arr = value.split(/[- :]/),
                            obj = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
                        return formatDate(obj, 'd NNN y H:m:s');
                    }},
                {head:'Printed',width:"1",data:'printed',align:'center',sort:true,type:'check'},
                {head:'',width:5,type:'custom',align:'center',render:function (records, value) {
                        return '<a href="{{ url($__admin_path.'/customer/print-request') }}/'+records.id+'" class="btn btn-warning">Print!</a>';
                    }}
            ];

            var filter  = [
                {data:'name',type:'text'},
                {data:'instagram_name',type:'text'},
                {data:'phone_number',type:'text'},
                {data:'address',type:'text'},
            ];

            var button  = {};


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

