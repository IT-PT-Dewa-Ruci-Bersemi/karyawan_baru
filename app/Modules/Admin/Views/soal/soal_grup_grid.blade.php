@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Grup',width:5,data:'grup',align:'left',sort:true,type:'text'},
                {head:'Publish',width:1,data:'publish',align:'center',sort:true,type:'check'},
            ];

            var filter  = [
                {data:'grup',type:'text'}
            ];

            var button  = {
                add:[{
                    name:'grup',
                    label:'Grup',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
                }],
                edit:[{
                    name:'grup',
                    label:'Grup',
                    type:'text',
                    required:true,
                    placeholder:'Input Soal'
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