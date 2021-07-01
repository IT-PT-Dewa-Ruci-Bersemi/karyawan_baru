@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Soal',width:4,data:'soal',align:'left',sort:true,type:'text'},
                {head:'Grup',width:4,data:'grup_id',align:'left',sort:true,type:'relation',belongsTo:['soal_grup','grup']},
                {head:'Detail',width:2,data:'detail',align:'center',sort:true,type:'text'},
                {head:'Detail',width:2,data:'type',align:'center',sort:true,type:'text'},
                {head:'Detail',width:2,data:'option',align:'center',sort:true,type:'text'},
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
                    name:'type',
                    label:'Tipe Soal',
                    type:'radio',
                    toggle:true,
                    required:true,
                    option:[
                        {value:"input",display:"Input"},
                        {value:"textarea",display:"Textarea"},
                        {value:"select",display:"Selection",toggle:"selection"},
                        {value:"table",display:"Table",toggle:"table"}
                    ]
                },{
                    name:'table',
                    type:'panel',
                    id:'table',
                    field: [{
                        name:'detail',
                        label:'Nama Route Detail',
                        type:'text',
                        required:true,
                        placeholder:'Input Nama Route Detail'
                    }]
                },{
                    name:'selection',
                    type:'panel',
                    id:'selection',
                    field: [{
                        name:'option',
                        label:'Opsi Pilihan',
                        type:'text',
                        required:true,
                        placeholder:'Input Opsi Pilihan'
                    }]
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
                    name:'type',
                    label:'Tipe Soal',
                    type:'radio',
                    toggle:true,
                    required:true,
                    option:[
                        {value:"input",display:"Input"},
                        {value:"textarea",display:"Textarea"},
                        {value:"select",display:"Selection",toggle:"selection"},
                        {value:"table",display:"Table",toggle:"table"}
                    ]
                },{
                    name:'table',
                    type:'panel',
                    id:'table',
                    field: [{
                        name:'detail',
                        label:'Nama Route Detail',
                        type:'text',
                        required:true,
                        placeholder:'Input Nama Route Detail'
                    }]
                },{
                    name:'selection',
                    type:'panel',
                    id:'selection',
                    field: [{
                        name:'option',
                        label:'Opsi Pilihan',
                        type:'text',
                        required:true,
                        placeholder:'Input Opsi Pilihan'
                    }]
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
