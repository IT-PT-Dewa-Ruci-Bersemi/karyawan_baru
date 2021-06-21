<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 10/09/20
 * Time: 11.27
 */
?>
@extends('admin::templates.master')

@section('menu')
    <a href="{{ route('admin_transaction_form') }}" class="btn btn-primary" title="Add Transaction"><i class="far fa-plus"></i></a>
@stop

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var header  = [
                {head:'Seller',width:6,data:'seller_id',type:'relation',belongsTo:['seller', 'name'],align:'left',sort:true},
                {head:'Total Customer',width:2,data:'total_cust',align:'center',sort:true},
                {head:'Last Update',width:"2",data:'updated_at',align:'left',type:'custom',sort:true,render:function (records, value) {
                        if(!value) return '';
                        var arr = value.split(/[- :]/),
                            obj = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
                        return formatDate(obj, 'd NNN y H:m:s');
                    }},
                {head:'Active',width:"1",data:'status_id',align:'center',sort:true,type:'check'},
                {head:'',width:"1",type:'custom',align:'center',render:function (records, value) {
                        return '<a href="{{ url($__admin_path.'/transaction/detail') }}/'+records.id+'">Detail</a>';
                    }},

            ];

            i_form.initGrid({
                header: header,
                button: [],
                sort: {{ $menu_default_sort }},
                data: {!! json_encode($records->toArray()) !!},
                pagination: '{!! $pagination !!}',
                menu_action: {!! json_encode($menu_action) !!}
            },$("#grid"));
        });
    </script>
@stop

