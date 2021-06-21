<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 30/07/19
 * Time: 17.22
 */
?>
@extends('admin::templates.master')

@section('head')
    <style>
        table {font-size: 11px;}
    </style>
@stop

@section('content')
    @if(isset($multiple_group_menu))
        @foreach($menu_list as $groupMenu)
            <div class="card">
                <div class="card-header">
                    <h5>{{ $groupMenu['group_name'] }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($groupMenu['menu'] as $menu)
                            <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white">
                                        <i class="fas fa-{{ $menu['icon'] }}"></i>
                                    </div>
                                    <div class="card-body">
                                        {{--<h4>{{ $menu['name'] }}</h4>--}}
                                        {{--<p>General settings such as,     site title, site description, address and so on.</p>--}}
                                        <a href="{{ route($menu['route']) }}" class="card-cta">{{ $menu['name'] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            @foreach($menu_list as $menu)
                <div class="col-lg-6">
                    <div class="card card-large-icons">
                        <div class="card-icon bg-primary text-white">
                            <i class="fas fa-{{ $menu['icon'] }}"></i>
                        </div>
                        <div class="card-body">
                            {{--<h4>{{ $menu['name'] }}</h4>--}}
                            {{--<p>General settings such as,     site title, site description, address and so on.</p>--}}
                            <a href="{{ route($menu['route']) }}" class="card-cta">{{ $menu['name'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@stop
