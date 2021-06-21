<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 17/11/20
 * Time: 08.57
 */
?>
@extends('admin::templates.master')

@section('content')
    <h3>Status Log</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($status_log as $index=>$log)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $log->created_at->format('d M Y H:i:s') }}</td>
                <td><span class="badge badge-{{ $log->status->badge_class }}"><i class="far fa-{{ $log->status->icon }}"></i> {{ $log->status->status_name }}</span></td>
                <td>{{ $log->admin->username }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
