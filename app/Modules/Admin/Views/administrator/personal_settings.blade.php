<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 18:34
 */
?>

@extends('admin::templates.master')

@section('content')
    <div class="box-body">
        <form method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row form-group">
                <div class="col-3">
                    Current Password
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" name="curr_password" required placeholder="Input your current password" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    New Password
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" name="new_password" required placeholder="Input your new password" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-3">
                    Confirm New Password
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" name="confirm_new_password" required placeholder="Confirm your new password" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-9 text-right">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
@stop

