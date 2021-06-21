<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 18:08
 */
?>

@extends("admin::templates.master")

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Name',width:"10",data:'name',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'},
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="{{ url($__admin_path.'/_core/navigation/master') }}/'+records.id+'">Detail</a>';
                }}
            ];

            var filter  = [
                {data:'name',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'name',
                    label:'Master Navigation',
                    type:'text',
                    required:true,
                    placeholder:'Input Master Navigation'
                }],
                edit:[{
                    name:'name',
                    label:'Master Navigation',
                    type:'text',
                    required:true,
                    placeholder:'Input Master Navigation'
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
