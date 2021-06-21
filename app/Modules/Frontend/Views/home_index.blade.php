<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 05/01/20
 * Time: 02.49
 */
?>
@extends('kerangka.master')
    @section('content')
    <table border="1">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Masuk</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student as $index=>$s)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->created_at->format('d M Y H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @stop
