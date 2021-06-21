<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 12:05 PM
 */
?>
<html>
<head>
    <title>{{ $meta_title }}</title>
    @if($favicon != '')<link rel="shortcut icon" href="{{ asset('components/shared/images/'.$favicon) }}" />@endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset($asset_path.'css/login.css') }}" />
    <script src="{{ asset('components/admin/themes/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script>
        $(function(){
            $('input[name=email]').focus();
        });
    </script>
</head>
<body id="body_colour">
<div id="content_login">
    <center>
        <p>ADMINISTRATOR LOGIN AREA</p>
    </center>
    <form action="{{ route('admin_login_process') }}" method="post" id="formlogin">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div><input type="text" name="username" placeholder="Username" autofocus /></div>
        <div><input type="password" name="password" placeholder="Password" /></div>
        <div><input type="submit" value="LOGIN" /></div>
    </form>
    @if(isset($errors))
        <div class="login-error">{!! $errors->first('email') !!}{!! $errors->first('password') !!}</div>
    @endif
</div>
</body>
</html>