<div class="badge-holder">
    @if($l->status_id >= 5)
        <b>{{ $l->shipper->shipper_name }}</b><br />
        <span class="badge badge-info">
            {{ $l->tracking_code }}
        </span>
        <div class="">
            @if($l->status_id == 5)
                @php
                    $result = json_decode($l->manifest_history);
                    if(count($result)) $end    = $result[0];
                    else $end = false;
                @endphp
                @if($end !== false)
                    <span class="badge badge-info">last update: {{ $l->last_fetch_date->format('D, d M Y H:i:s') }}</span>
                    <div><small>{{ $end->manifest_date.' '.$end->manifest_time }} &nbsp; <mark>{{ $end->manifest_description }}</mark><br />{{ $end->city_name }}</small></div>
                @else
                    <small>No History yet</small>
                @endif
            @else
                <span class="mt-2 mb-2 badge badge-{{ $l->status->badge_class }}"><i class="far fa-{{ $l->status->icon }}"></i> {{ $l->status->status_name }}</span><br />
            @endif
        </div>
    @else
        <span class="mt-2 mb-2 badge badge-{{ $l->status->badge_class }}" data-toggle="tooltip" title="{{ $l->status->status_name }}"><i class="far fa-{{ $l->status->icon }}"></i></span><br />
        @if($l->status_id == 2)
            <button class="btn btn-block btn-primary btn-update-status" data-target="{{ $l->id }}" data-toggle="tooltip" title="Complete Payment"><i class="far fa-check"></i></button>
        @elseif($l->status_id == 3)
            <button class="btn btn-block btn-info btn-update-status" data-target="{{ $l->id }}" data-toggle="tooltip" title="Preparing Package"><i class="far fa-box-open"></i></button>
        @elseif($l->status_id == 4)
            <select class="form-control select-shipper" name="shipper_id" id="select-shipper-{{ $l->id }}">
                <option value="" selected>Select Shipper</option>
                @foreach($master_ship as $ship)
                    <option value="{{ $ship->id }}">{{ $ship->shipper_name }}</option>
                @endforeach
            </select>
            <div class="input-group">
                <input type="text" class="form-control input-shipment-code" placeholder="Input Track No." data-id="{{ $l->id }}" id="input-shipment-code-{{ $l->id }}" />
                <div class="input-group-prepend">
                    <button class="btn btn-info btn-update-status" data-target="{{ $l->id }}" data-status="{{ $l->status_id }}" data-toggle="tooltip" title="Shipment"><i class="far fa-shipping-fast"></i></button>
                </div>
            </div>
        @endif
    @endif
</div>