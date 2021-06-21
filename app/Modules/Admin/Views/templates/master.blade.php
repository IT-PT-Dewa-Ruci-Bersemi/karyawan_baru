<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin::templates.parts.head')
    @yield('head')
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1 ">
        <div class="navbar-bg"></div>
        @include('admin::templates.parts.header')
        @include('admin::templates.parts.menu')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>{{ Str::limit($page_title, 30) }}</h1>
                    <div class="section-header-button">
                        @foreach($menu_default as $name=>$value)
                            @if($value->type == 'form')
                                <a data-target="#modal-{{ $name }}" title="{{ ucwords($name) }}" href="#" data-toggle="tooltip" class="btn btn-primary menu-default">
                                    <i class="far {{ $value->image }}"></i>
                                </a>
                            @elseif($value->type == 'link')
                                <a title="{{ ucwords($name) }}" href="{{ is_array($value->route) ? route($value->route[0], $value->route[1]) : route($value->route) }}" href="#" data-toggle="tooltip" class="btn btn-primary menu-default">
                                    <i class="far {{ $value->image }}"></i>
                                </a>
                            @elseif($value->type == 'order')
                                <a title="{{ ucwords($name) }}" class="btn btn-primary menu-order" href="#" data-toggle="tooltip" id="menu-default-{{ $name }}">
                                    <i class="far {{ $value->image }}"></i>
                                </a>
                            @endif
                        @endforeach
                        @yield('menu')
                    </div>
                    {!! \App\Modules\Libraries\Breadcrumb::get() !!}
                </div>
                {!! \App\Modules\Libraries\Alert::show() !!}
                @yield('content')
                <div id="grid"></div>
            </section>
        </div>
        @include('admin::templates.parts.footer')
    </div>
    <div class="overlay"></div>
    <div class="loading">Loading&#8230;</div>
</div>
<div class="modal-holder">
@yield('modal_holder')
</div>
@include('admin::templates.parts.footer_script')
</body>
</html>