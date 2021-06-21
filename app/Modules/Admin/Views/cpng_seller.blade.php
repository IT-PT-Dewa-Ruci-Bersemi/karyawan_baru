<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 20/08/20
 * Time: 12.51
 */
?>
@extends("admin::templates.master")

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Name',width:"3",data:'name', align:'left',sort:true},
                {head:'IG Name',width:"3",data:'ig_name', align:'left',sort:true},
                {head:'Phone Number',width:"3",data:'phone_number', align:'left',sort:true},
            ];

            var filter  = [
                {data:'name',type:'text'},
                {data:'ig_name',type:'text'},
                {data:'phone_number',type:'text'},
            ];

            var button  = {
                add:[{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Name'
                },{
                    name:'ig_name',
                    label:'IG Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Instagram Name'
                }, {
                    name:'phone_number',
                    label:'Phone',
                    type:'text',
                    required:true,
                    placeholder:'Phone Number'
                }],
                edit:[{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Name'
                },{
                    name:'ig_name',
                    label:'IG Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Instagram Name'
                },{
                    name:'phone_number',
                    label:'Phone',
                    type:'text',
                    required:true,
                    placeholder:'Phone Number'
                }]
            };


            i_form.initGrid({
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

