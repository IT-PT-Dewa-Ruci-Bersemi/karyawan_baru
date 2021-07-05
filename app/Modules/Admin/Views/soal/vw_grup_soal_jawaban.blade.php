@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Grup',width:3,data:'grup',align:'left',sort:true,type:'text'},
                {head:'Jawab',width:1,data:'jawaban',align:'center',sort:true,type:'text'},
                {head:'Cek',width:1,data:'cek',align:'center',sort:true,type:'check'},
                {head:'',width:"2",type:'custom',align:'center',render:function (records, value) {
                    return '<a href="{{ url($__admin_path.'/cek') }}/'+records.id+'">Detail</a>';
                }},

            ];

            var filter  = [];

            var button  = {};


            i_form.initGrid({
                number: true,
                header: header,
                filter: [],
                button: [],
                sort: {{ $menu_default_sort }},
                data: {!! json_encode($records->toArray()) !!},
                pagination: '{!! $pagination !!}',
                menu_action: {!! json_encode($menu_action) !!}
            },$("#grid"));
        });
    </script>
@stop
