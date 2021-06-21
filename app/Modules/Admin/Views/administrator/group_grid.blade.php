<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 20/06/2016
 * Time: 10:19
 */
?>
@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Admin Group Name',width:"8",data:'name',align:'left',sort:true},
                {head:'Level',width:"3",data:'level',align:'left',sort:true},
                {head:'Active',width:"1",data:'active',align:'center',sort:true,type:'check'},
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="{{ url($__admin_path.'/administrator_group/permission') }}/'+records.id+'">Permissions</a>';
                }}
            ];

            var filter  = [
                {data:'name', type:'text'}
            ];

            var button  = {
                add:[{
                    name:'name',
                    label:'Group Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Group Name'
                },{
                    name:'level',
                    label:'Level',
                    type:'number',
                    placeholder:'Input Number of Level (1-{{ $level }})',
                    properties: {
                        min:1
                    },
                    required:true
                }],
                edit:[{
                    name:'name',
                    label:'Group Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Group Name'
                },{
                    name:'level',
                    label:'Level',
                    type:'number',
                    placeholder:'Input Number of Level (1-{{ $level }})',
                    properties: {
                        min:1,
                        max:{{ $level }}
                    },
                    required:true
                }]
            };

            i_form.initGrid({
                header: header,
                filter:filter,
                button: button,
                sort: {{ $menu_default_sort }},
                data: {!! json_encode($records->toArray()) !!},
                pagination: '{!! $pagination !!}',
                menu_action: {!! json_encode($menu_action) !!}
            },$("#grid"));
        });
    </script>
@stop

