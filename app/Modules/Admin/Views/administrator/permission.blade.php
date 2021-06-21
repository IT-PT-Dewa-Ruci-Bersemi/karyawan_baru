<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 20/06/2016
 * Time: 21:11
 */
?>
@extends('admin::templates.master')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $("input[type=checkbox]").on("click", function(event) {
                event.stopPropagation();
                var data    = $(this).data('permission');

                if(data) {
                    var name    = $(this).attr('name');
                    var checked = $(this).prop('checked');

                    data    = data.split('-');

                    var clickedLevel    = data[0];
                    var dataID          = data[1];
                    var holder          = $("#cl-"+clickedLevel+"-"+dataID+" input[type='checkbox']");

                    var tempName    = name.split('-');
                    if(tempName.length > 2) {
                        var target  = 'nav';
                        for(var i=1;i<tempName.length;i++) {
                            target+='-'+tempName[i];
                            if(checked) $("input[name='"+target+"']").prop('checked', 'checked');
                        }
                    }

                    if(checked) holder.prop('checked', 'checked');
                    else holder.removeAttr('checked');
                } else {
                    var checked = $(this).prop('checked');
                    var parent  = $(this).data('parent');
                    var tempParent  = parent.split('-');
                    var target  = 'nav';

                    for(var i=1;i<tempParent.length;i++) {
                        target+='-'+tempParent[i];
                        if(checked) $("input[name='"+target+"']").prop('checked', 'checked');
                    }
                }
            });
        });
    </script>
@stop
@section('content')
    <div class="container-fluid">
        <form method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="" id="user-permission">
                @foreach($mNavigationList as $key=>$mNav)
                    <div class="panel card box-primary">
                        <div class="card-header with-border">
                            <a data-toggle="collapse" class="nav-0" data-target="#cl-0-{{ $mNav->id }}">
                                <input type="checkbox" name="nav-{{ $mNav->id }}" data-permission="0-{{ $mNav->id }}" {{ in_array($mNav->id, $groupMasterNav) ? 'checked' : '' }} />
                                {{ $mNav->name }}
                            </a>
                        </div>
                        <div id="cl-0-{{ $mNav->id }}" class="panel-collapse collapse">
                            <div class="card-body list-1-container">

                                {{--nav circle 1--}}
                                @foreach($mNav->navigation()->get() as $key1=>$nav)
                                    <div class="panel card box-success">
                                        <div class="card-header with-border">
                                            <a data-toggle="collapse" class="nav-1" data-target="#cl-1-{{ $nav->id }}">
                                                <input type="checkbox" name="nav-{{ $mNav->id }}-{{ $nav->id }}" data-permission="1-{{ $nav->id }}" {{ array_key_exists($nav->id, $groupNavPermission) ? 'checked' : '' }} />
                                                <i class="fa {{ $nav->image }}"></i> {{ $nav->menu }}
                                            </a>
                                        </div>
                                        <div id="cl-1-{{ $nav->id }}" class="panel-collapse collapse">
                                            @if($nav->subNav()->count())
                                                <div class="card-body list-2-container">


                                                    {{--nav circle 2--}}
                                                    @foreach($nav->subNav()->get() as $subNav)
                                                        <div class="panel card box-success">
                                                            <div class="card-header with-border">
                                                                <a data-toggle="collapse" class="nav-2" data-target="#cl-2-{{ $subNav->id }}">
                                                                    <input type="checkbox" name="nav-{{ $mNav->id }}-{{ $nav->id }}-{{ $subNav->id }}" data-permission="2-{{ $subNav->id }}" {{ array_key_exists($subNav->id, $groupNavPermission) ? 'checked' : '' }} />
                                                                    <i class="fa {{ $subNav->image }}"></i> {{ $subNav->menu }}
                                                                </a>
                                                            </div>
                                                            <div id="cl-2-{{ $subNav->id }}" class="panel-collapse collapse">
                                                                @if($subNav->menu_action || $subNav->menu_default || $subNav->special_permission)
                                                                    <div class="card-body list-action">
                                                                        @if(count(explode(';', $subNav->menu_action)) && $subNav->menu_action != null)
                                                                            @foreach(explode(';', $subNav->menu_action) as $index=>$menu)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="{{ $menu }}-{{ $subNav->id }}" {{ isset($groupNavPermission[$subNav->id]['menu_action']) ? in_array($menu, $groupNavPermission[$subNav->id]['menu_action']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}-{{ $subNav->id }}" type="checkbox"> {{ ucwords(str_replace('_', ' ', $menu)) }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if(count(json_decode($subNav->menu_default, true) ? json_decode($subNav->menu_default, true) : []))
                                                                            @foreach(json_decode($subNav->menu_default, true) as $index=>$menu)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="d-{{ $index }}-{{ $subNav->id }}" {{ isset($groupNavPermission[$subNav->id]['menu_default']) ? in_array($index, $groupNavPermission[$subNav->id]['menu_default']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}-{{ $subNav->id }}" type="checkbox"> {{ ucwords($index) }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    @if($subNav->special_permission != null && count(explode(';',$subNav->special_permission)))
                                                                        <div class="card-body list-action special-permission">
                                                                            <h4>Special Permission</h4>
                                                                            @foreach(explode(';',$subNav->special_permission) as $index=>$menu)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="s-p-{{ $menu }}-{{ $subNav->id }}" {{ isset($groupNavPermission[$subNav->id]['special_permission']) ? in_array($menu, $groupNavPermission[$subNav->id]['special_permission']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}-{{ $subNav->id }}" type="checkbox"> {{ ucwords(str_replace('_', ' ', $menu)) }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{--nav circle 2--}}

                                                </div>

                                            @else
                                                @if($nav->menu_action || $nav->menu_default || $nav->special_permission)
                                                    <div class="card-body list-action">
                                                        <div>
                                                            @if(count(explode(';', $nav->menu_action)) && $nav->menu_action != null)
                                                                @foreach(explode(';', $nav->menu_action) as $index=>$menu)
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="{{ $menu }}-{{ $nav->id }}" {{ isset($groupNavPermission[$nav->id]['menu_action']) ? in_array($menu, $groupNavPermission[$nav->id]['menu_action']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}" type="checkbox"> {{ ucwords(str_replace('_', ' ', $menu)) }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            @if(count(json_decode($nav->menu_default, true) ? json_decode($nav->menu_default, true) : []))
                                                                @foreach(json_decode($nav->menu_default, true) as $index=>$menu)
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="d-{{ $index }}-{{ $nav->id }}" {{ isset($groupNavPermission[$nav->id]['menu_default']) ? in_array($index, $groupNavPermission[$nav->id]['menu_default']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}" type="checkbox"> {{ ucwords($index) }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        @if(count(explode(';',$nav->special_permission)) && $nav->special_permission != null)
                                                            <div class="card-body list-action special-permission">
                                                                <h4>Special Permission</h4>
                                                                @foreach(explode(';',$nav->special_permission) as $index=>$menu)

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input name="s-p-{{ $menu }}-{{ $nav->id }}" {{ isset($groupNavPermission[$nav->id]['special_permission']) ? in_array($menu, $groupNavPermission[$nav->id]['special_permission']) ? 'checked': '' : '' }} data-parent="parent-{{ $mNav->id }}-{{ $nav->id }}" type="checkbox"> {{ ucwords(str_replace('_', ' ', $menu)) }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                {{--end of nav circle 1--}}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center padding-15">
                <button class="btn btn-success" type="submit"><i class="far fa-save"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
@stop
