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
                {head:'Position',width:1,data:'position_id',align:'left',sort:true,type:'relation',belongsTo:['position','name']},
                {head:'Email',width:2,data:'email',align:'left',sort:true},
                {head:'Username',width:2,data:'username',align:'left',sort:true},
                {head:'Name',width:2,data:'name',align:'left',sort:true},
                {head:'Gender',width:1,data:'gender',align:'left',type:'custom',sort:true,render:function(records, value) {
                    if(value == 'male') return '<center><i class="fa fa-male text-primary"></i></center>';
                    return '<center><i class="fa fa-female text-danger"></i></center>';
                }},
                {head:'Active',width:"1",data:'active',align:'center',sort:true,type:'check'}
            ];

            var filter  = [
                {data:'position_id',type:'select', options: $.parseJSON('{!! json_encode($positions) !!}')},
                {data:'name',type:'text'},
                {data:'username',type:'text'},
                {data:'email',type:'text'},
                {data:'gender', type:'select', options:[
                    {display:'Male', value:'male'},
                    {display:'Female', value:'female'}
                ]}
            ];

            var button  = {
                add:[{
                    name:'position_id',
                    label:'Position',
                    type:'select',
                    data:{!! json_encode($positions) !!},
                    required:true
                },{
                    name:'email',
                    label:'Email',
                    type:'email',
                    required:true,
                    placeholder:'Input Admin Email'
                },{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Admin Name'
                },{
                    name:'username',
                    label:'Username',
                    type:'text',
                    placeholder:'Input Admin Username'
                },{
                    name:'gender',
                    label:'Gender',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"male",display:"Male"},
                        {value:"female",display:"Female"}
                    ]
                }],
                edit:[{
                    name:'position_id',
                    label:'Position',
                    type:'select',
                    data:{!! json_encode($positions) !!},
                    required:true
                },{
                    name:'email',
                    label:'Email',
                    type:'email',
                    required:true,
                    placeholder:'Input Admin Email'
                },{
                    name:'name',
                    label:'Name',
                    type:'text',
                    required:true,
                    placeholder:'Input Admin Name'
                },{
                    name:'username',
                    label:'Username',
                    type:'text',
                    placeholder:'Input Admin Username'
                },{
                    name:'gender',
                    label:'Gender',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"male",display:"Male"},
                        {value:"female",display:"Female"}
                    ]
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
