@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Soal',width:4,data:'soal',align:'left',sort:true,type:'text'},
                {head:'Grup',width:4,data:'grup_id',align:'left',sort:true,type:'relation',belongsTo:['soal_grup','grup']},
                {head:'Detail',width:2,data:'detail',align:'center',sort:true,type:'text'},
                {head:'Publish',width:1,data:'publish',align:'center',sort:true,type:'check'},
            ];

            var filter  = [
                {data:'category_id',type:'select', options: $.parseJSON('{!! json_encode($soal_grup) !!}')},
                {data:'soal',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'grup_id',
                    label:'Soal Parent',
                    type:'select',
                    data:{!! json_encode($soal_grup) !!},
                    required:true
                },{
                    name:'soal',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Nama Route Detail',
                    type:'text',
                    required:true,
                    placeholder:'Input Nama Route Detail'
                }],
                edit:[{
                    name:'grup_id',
                    label:'Soal Parent',
                    type:'select',
                    data:{!! json_encode($soal_grup) !!},
                    required:true
                },{
                    name:'soal',
                    label:'Soal',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                },{
                    name:'detail',
                    label:'Nama Route Detail',
                    type:'text',
                    required:false,
                    placeholder:'Input Nama Route Detail'
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
