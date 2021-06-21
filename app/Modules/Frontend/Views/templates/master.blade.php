<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 02.50
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $_meta_descriptions }}">
    <meta name="keywords" content="{{ $_meta_keywords }}">
    <title>{{ $site_title }}</title>
    <!-- Favicon -->
    <link href="{{ asset('components/images/'.$favicon) }}" rel="shortcut icon">
    @include('templates.includes.css')
</head>
<body data-preloader="2">
@include('templates.includes.header')

<!-- Scroll to top button -->
<div class="scrolltotop padding-10">
    <a class="button-circle button-circle-sm button-circle-dark" href="#"><i class="ti-arrow-up"></i></a>
</div>
<!-- end Scroll to top button -->
@yield('content')

@include('templates.includes.footer_scripts')
<!-- ***** JAVASCRIPTS ***** -->
</body>
</html>