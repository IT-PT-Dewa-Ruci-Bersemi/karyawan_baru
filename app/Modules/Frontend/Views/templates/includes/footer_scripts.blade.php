<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 22.09
 */
?>

<script src="{{ asset('components/shared/plugins/jQuery/jquery.min.js')  }}"></script>
<script src="{{ asset('components/frontend/js/plugins.js') }}"></script>
<script src="{{ asset('components/frontend/js/functions.js') }}"></script>
@include('templates.includes.google-analytics')
@yield('scripts')