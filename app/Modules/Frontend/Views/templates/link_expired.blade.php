<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 15/12/19
 * Time: 01.01
 */
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>{{ $title }}</title>
    <meta property="og:site_name" content="Betta Topan">
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="" />
    <meta property="og:image" itemprop="image" content="{{ asset('components/images/og_image.jpg') }}">
    <meta property="og:type" content="website" />
    <!-- Favicon -->
    <link href="{{ asset('components/images/favicon.png') }}" rel="shortcut icon">
    <!-- CSS -->
    <link href="{{ asset('components/frontend/coming_soon/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/shared/plugins/owlcarousel2/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/shared/plugins/owlcarousel2/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/frontend/coming_soon/css/magnific-popup.min.css') }}" rel="stylesheet">

    <link href="{{ asset('components/frontend/coming_soon/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('components/frontend/coming_soon/css/coming_soon.css') }}" rel="stylesheet">
    <!-- Fonts/Icons -->
    <link href="{{ asset('components/shared/fontawesome/css/all.min.css') }}" rel="stylesheet">
</head>
<body data-preloader="2">

<!-- ***** JAVASCRIPTS ***** -->
<script src="{{ asset('components/frontend/coming_soon/js/jquery.min.js') }}"></script>
<script src="{{ asset('components/frontend/coming_soon/js/plugins.js') }}"></script>
<script src="{{ asset('components/frontend/coming_soon/js/functions.js') }}"></script>
@include('templates.includes.google-analytics')
</body>
</html>
