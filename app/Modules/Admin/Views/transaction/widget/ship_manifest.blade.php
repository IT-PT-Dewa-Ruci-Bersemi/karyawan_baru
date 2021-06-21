<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 17/11/20
 * Time: 13.54
 */
?>
<h5>{{ $customer }}</h5>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($manifest as $index=>$history)
            <tr>
                <td>{{ $index+1 }}</td>
                <td><span class="badge badge-info">{{ $history->manifest_date }} {{ $history->manifest_time }}</span></td>
                <td><small>{{ $history->manifest_description }} {{ $history->city_name }}</small></td>
            </tr>
        @endforeach
    </tbody>
</table>
