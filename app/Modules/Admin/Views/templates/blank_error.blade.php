<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 10/10/2015
 * Time: 8:21 AM
 */
?>
<html>
<head>
    <title>Error Occured</title>
    <style>
        * {font-family: sans-serif;font-size: 13px;text-align: center;}
        body {position: relative;}
        div {position: absolute;top:50%;transform: translateY(-50%);left:0;right:0;}
    </style>
</head>
<body>
    <div>{!! $die_msg !!}</div>
</body>
</html>