<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 24/08/20
 * Time: 12.39
 */
?>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('components/shared/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        *{
            font-size: 105%;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="table">
        @foreach($list as $l)
            <tr>
                <td width="600">
                    <b>{{ $l->customer_name }}</b> ({{ $l->customer_phone }}) <br />
                    {{ $l->customer_address }}
                </td>
                <td align="center" class="text-center">
                    <b>{{ $seller->name }}</b> <br />
                    {{ $seller->phone_number }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>