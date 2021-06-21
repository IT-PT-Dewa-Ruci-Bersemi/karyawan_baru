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
        @foreach($list as $customerID=>$sellerID)
            <tr>
                <td width="600">
                    <b>{{ $customer[$customerID]->name }}</b> ({{ $customer[$customerID]->phone_number }}) <br />
                    {{ $customer[$customerID]->address }}
                </td>
                <td align="center" class="text-center">
                    <b>{{ $seller[$sellerID]->name }}</b> <br />
                    {{ $seller[$sellerID]->phone_number }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>