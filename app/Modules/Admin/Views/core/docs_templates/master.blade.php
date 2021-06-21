<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/02/2018
 * Time: 11:17
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
@include('admin::templates.parts.head')
@yield('head')
</head>
<body class="hold-transition skin-yellow fixed sidebar-mini">
<div class="wrapper">
    @include('admin::templates.parts.header')
    @include('admin::core.docs_templates.parts.menu')
    <div class="content-wrapper">
        <section class="content">
            <div class="menuHolder clearfix">

                @foreach($menu_default as $name=>$value)
                    @if($value->type == 'form')
                        <a data-target="#modal-{{ $name }}" title="{{ ucwords($name) }}" class="btn btn-primary pull-right menu-default">
                            <span class="fa {{ $value->image }} margin-r-5"></span> {{ ucfirst($name) }}
                        </a>
                    @elseif($value->type == 'link')
                        <a title="{{ ucwords($name) }}" href="{{ is_array($value->route) ? route($value->route[0], $value->route[1]) : route($value->route) }}" class="btn btn-primary pull-right menu-default">
                            <span class="fa {{ $value->image }} margin-r-5"></span> {{ ucfirst($name) }}
                        </a>
                    @elseif($value->type == 'order')
                        <a title="{{ ucwords($name) }}" class="btn btn-primary pull-right menu-order" id="menu-default-{{ $name }}">
                            <span class="fa {{ $value->image }} margin-r-5"></span> {{ ucfirst($name) }}
                        </a>
                    @endif
                @endforeach
                @yield('menu')
            </div>
            <div>{!! \App\Modules\Libraries\Alert::show() !!}</div>
            <div id="grid"></div>
            @yield('content')
        </section><!-- /.content -->
    </div>
    @include('admin::templates.parts.footer')
</div>
</body>
</html>