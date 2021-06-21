<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $page_title }}{{ $meta_title != '' ? ' | '.$meta_title : ''}}</title>
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">
<!-- Bootstrap CSS-->
<!-- Favicon-->
@if(env('app_env') == 'production')
<script src="https://kit.fontawesome.com/9a2beca39e.js" crossorigin="anonymous"></script>
@else
<link rel="stylesheet" href="{{ asset('components/shared/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('components/shared/fontawesome/css/brands.min.css') }}">
@endif

<link rel="stylesheet" href="{{ asset('components/shared/plugins/bootstrap/css/bootstrap.min.css') }}">
{{--<!-- Google fonts - Muli-->--}}
{{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">--}}
<!-- theme stylesheet-->
<link rel="stylesheet" href="{{ asset('components/admin/themes/stisla/css/style.css') }}" id="theme-stylesheet">
<link rel="stylesheet" href="{{ asset('components/admin/themes/stisla/css/components.css') }}" id="theme-stylesheet">

<link rel="stylesheet" href="{{ asset($asset_path.'css/styles.css') }}" />
<link rel="stylesheet" href="{{ asset($asset_path.'css/admin_style.css') }}" />
<link rel="stylesheet" href="{{ asset($asset_path.'css/i_form.css') }}" />
<link rel="stylesheet" href="{{ asset($asset_path.'css/loading-bar.min.css') }}" />
@yield('style')

@if($favicon != '')<link rel="shortcut icon" href="{{ asset('components/images/'.$favicon) }}" />@endif