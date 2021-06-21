@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Soal',width:2,data:'parent_id',sort:true, align:'left',type:'relation',belongsTo:['soal','menu']},
                {head:'Detail',width:2,data:'detail',align:'center',sort:true,type:'check'},
                {head:'Publish',width:2,data:'publish',align:'center',sort:true,type:'check'},
            ];

            var filter  = [
                {data:'category_id',type:'select', options: $.parseJSON('{!! json_encode($soal) !!}')},
                {data:'soal',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'parent_id',
                    label:'Soal Parent',
                    type:'select',
                    data:{!! json_encode($soal) !!},
                    required:true
                },{
                    name:'nama',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"1",display:"Ya"},
                        {value:"0",display:"tidak"}
                    ]
                }],
                edit:[{
                    name:'parent_id',
                    label:'Soal Parent',
                    type:'select',
                    data:{!! json_encode($soal) !!},
                    required:true
                },{
                    name:'nama',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Detail',
                    type:'radio',
                    required:true,
                    option:[
                        {value:"1",display:"Ya"},
                        {value:"0",display:"tidak"}
                    ]
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