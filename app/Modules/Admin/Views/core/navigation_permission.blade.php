<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 18/02/2018
 * Time: 18:53
 */
?>
@extends('admin::templates.master')

@section('scripts')
    {!! \App\Modules\Libraries\Plugin::get('select2') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "Add Your Special Permission"
            });
        });
    </script>
@stop

@section('menu')
    <a href="{{ $back_url }}" class="btn pull-right btn-primary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form>
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Menu Default</h4>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="add" {{ isset($menu['default']->add) ? 'checked' : '' }} /> <i class="fa fa-plus"></i> Add
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="order" {{ isset($menu['default']->order) ? 'checked' : '' }} /> <i class="fa fa-bars"></i> Order
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Menu Action</h4>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="action[edit]" {{ in_array('edit', $menu['action']) ? 'checked': '' }} /> <i class="fa fa-pencil"></i> Edit
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="action[delete]" {{ in_array('delete', $menu['action']) ? 'checked' : '' }} /> <i class="fa fa-trash"></i> Delete
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="action[fast_edit]" {{ in_array('fast_edit', $menu['action']) ? 'checked' : '' }} /> <i class="fa fa-check"></i> Edit Check Mark
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <h4>Special Permission</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <select id="tags" name="special_permission[]" class="form-control" multiple="multiple">
                                @foreach($menu['special'] as $special)
                                    <option selected="selected">{{ $special }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br />
                    <small><b>Each time you save, it will reset all permission. Please re-assign to all administrator after save.</b></small>
                    <br />
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
@stop
