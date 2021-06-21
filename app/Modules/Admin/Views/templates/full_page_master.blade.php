<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 30/06/20
 * Time: 13.30
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    @include('admin::templates.parts.head')
    @yield('head')
</head>
<body>
@yield('content')
@include('admin::templates.parts.footer_script')
</body>
</html>
