<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 17:59
 */
?>
@extends('admin::templates.master')

@section('scripts')
    {!! \App\Modules\Libraries\Plugin::get('icheck') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('.nav-tabs li a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
                history.pushState(null, null, $(this).attr('href'));
            });

            // navigate to a tab when the history changes
            window.addEventListener("popstate", function(e) {
                var activeTab = $('[href=' + location.hash + ']');
                if (activeTab.length) {
                    activeTab.tab('show');
                } else {
                    $('.nav-tabs a:first').tab('show');
                }
            });

            $('input[type="radio"].maintenance_check').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
        });
    </script>
@stop

@section('menu')
    <a href="{{ route('admin_test') }}" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Back</a>
@stop

@section('content')
    <br />
    <ul class="nav nav-tabs">
        <li class="active"><a href="#config">Apps Config</a></li>
    </ul>
    <div class="tab-content">
        <div id="config" class="tab-pane active">
            <form method="post" action="{{ route('admin_test_save_apps_config') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <br />
                @foreach($config as $name=>$value)
                <div class="form-group">
                    <label for="{{ $name }}">{{ ucfirst(str_replace('_', ' ', $name)) }}</label>
                    <input name="{{ $name }}" class="form-control" id="{{ $name }}" value="{{ $value }}" />
                </div>
                @endforeach
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>

        {{--<div id="image" class="tab-pane">--}}
        {{--b--}}
        {{--</div>--}}
        {{--<div id="stock" class="tab-pane">--}}
        {{--c--}}
        {{--</div>--}}

    </div>


@stop
