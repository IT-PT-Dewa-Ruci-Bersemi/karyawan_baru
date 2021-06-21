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
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<i class="fa '+records.image+'"></i>';
                    }},
                {head:'Label',width:"3",data:'menu',align:'left',sort:true},
                {head:'System Alias',width:"3",data:'name',align:'left',sort:true},
                {head:'Route',width:"4",data:'route',align:'left',sort:true},
                {head:'Active',width:"1",data:'publish',align:'center',sort:true,type:'check'},
                {head:'', width:"1",type:'custom',render:function(records, value) {
                    if(!records.subnav.length) {
                        return '<a href="{{ url($__admin_path.'/_core/navigation/permission/') }}/'+records.id+'">Permission</a>';
                    } else {
                        return '';
                    }
                }}
                @if($enableTree)
                ,{head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<a href="{{ url($__admin_path.'/_core/navigation/') }}/'+records.master_navigation_id+'/'+records.id+'">Detail</a>';
                    }}
                @endif
            ];

            var filter  = [
                {data:'name',type:'text'}
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
                    type:'hidden',
                    value:'{{ $total_data + 1 }}'
                },{
                    name:'master_navigation_id',
                    type:'hidden',
                    value:'{{ $mnavid }}'
                },{
                    name:'name',
                    label:'System Alias',
                    type:'text',
                    placeholder:'Input System Alias'
                },{
                    name:'menu',
                    label:'Label',
                    type:'text',
                    required:true,
                    placeholder:'Input Label Menu Name'
                }, {
                    name:'route',
                    label:'Route',
                    type:'text',
                    placeholder:'Input Admin Route'
                }, {
                    name:'image',
                    label:'Image',
                    type:'text',
                    required:true,
                    placeholder:'Input Font Awesome Icon CSS'
                }],
                edit:[{
                    name:'master_navigation_id',
                    type:'hidden',
                    value:'{{ $mnavid }}'
                },{
                    name:'name',
                    label:'System Alias',
                    type:'text',
                    placeholder:'Input System Alias'
                },{
                    name:'menu',
                    label:'Label',
                    type:'text',
                    required:true,
                    placeholder:'Input Label Menu Name'
                }, {
                    name:'route',
                    label:'Route',
                    type:'text',
                    placeholder:'Input Admin Route'
                }, {
                    name:'image',
                    label:'Image',
                    type:'text',
                    required:true,
                    placeholder:'Input Font Awesome Icon CSS'
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
