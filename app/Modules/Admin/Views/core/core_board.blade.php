<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/09/2017
 * Time: 21:14
 */
?>
@extends('admin::templates.master')

@section('content')
    <div class="container-fluid">
        <div class="block">
            <h4>List of Testing Module</h4>
            <ul>
                @foreach($modules as $module)
                    <li>
                        <a href="{{ route($module['route']) }}" target="_blank">{{ $module['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop