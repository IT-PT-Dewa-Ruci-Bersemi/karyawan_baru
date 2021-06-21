<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 22/02/2018
 * Time: 13:25
 */
?>
@extends("admin::templates.master")

@section('scripts')
    {!! \App\Modules\Libraries\Plugin::get('editor') !!}
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Title',width:"10",data:'menu',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'}
                @if($view_detail)
                ,{head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<a href="{{ url($__admin_path.'/_core/docs') }}/'+records.id+'">Detail</a>';
                    }}
                @endif
            ];

            var filter  = [
                {data:'menu',type:'text'}
            ];

            var button  = {
                add:[
                    @if($parent_id)
                    {
                        name:'parent_id',
                        type:'hidden',
                        value: '{{ $parent_id }}'
                    },
                        @endif
                    {
                        name:'order_id',
                        type:'hidden'
                    },{
                        name:'menu',
                        label:'Title',
                        type:'text',
                        required:true,
                        permalink:true,
                        placeholder:'Input Docs Title'
                    },{
                        name:'detail',
                        label:'Detail',
                        type:'editor',
                        admin:true
                    }],
                edit:[{
                    name:'menu',
                    label:'Title',
                    type:'text',
                    required:true,
                    permalink:true,
                    placeholder:'Input Docs Title'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'editor',
                    admin:true
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

