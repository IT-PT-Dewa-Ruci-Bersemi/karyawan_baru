<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 16/11/20
 * Time: 08.13
 */
?>
@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Name',width:10,data:'shipper_name',align:'left',sort:true},
                {head:'Active',width:2,data:'publish',align:'center',sort:true,type:'check'}
            ];

            var filter  = [
                {data:'name',type:'text'}
            ];

            var button  = {
                edit:[{
                    name:'shipper_name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Shipper Name'
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
