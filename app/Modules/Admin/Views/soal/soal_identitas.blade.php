@extends('admin::templates.master')
@section('scripts')
    {!! \App\Modules\Libraries\Plugin::get('datepicker') !!}
    <script type="text/javascript">
        $(".tanggal").datepicker();
    </script>
@endsection

@section('content')
<div class="container">
    <form class="well form-horizontal" action="{{ route('move') }}" method="post" id="contact_form">
        @csrf
            <!-- Form Name -->
            <legend><h2><b> {{ $grup->grup }} </b></h2></legend><br>
            <input type="hidden" name="grup_id" value="{{$grup->id}}" >
            @php
                $temp_datepicker=[];
            @endphp
            @foreach ($soals as $index=>$soal)
            @switch($soal->type)
                @case("input")
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <input name="jawaban[]" placeholder="{{ $soal->soal }}" class="form-control" type="text" value="{{ $soal->jawaban }}">
                            </div>
                        </div>
                    </div>
                    @break
                @case("textarea")
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <textarea id="jawaban" name="jawaban[]" placeholder="{{ $soal->soal }}" class="form-control" value="{{ $soal->jawaban }}">
                            </div>
                        </div>
                    </div>
                    @break
                @case("select")
                    @php
                        if ($soal->option=='') {
                        goto skip;
                        }
                        $options=explode(';',$soal->option);
                    @endphp
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <select name="jawaban[]" class="form-control selectpicker">
                                <option value="">Please select</option>
                                @foreach ($options as $option)
                                    <option value="{{ $option }}" {{ $soal->jawaban==$option?'selected':'' }}>{{ $option }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @php
                        skip:
                    @endphp
                    @break
                @case("datepicker")
                    @php
                        array_push($temp_datepicker,$index);
                    @endphp
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <input value="{{ $soal->jawaban }}" type="text" name="jawaban[]" class="form-control tanggal" id="datepicker-{{ $index }}">
                            </div>
                        </div>
                    </div>
                    @break
                @case("datepicker")
                    @php
                        array_push($temp_datepicker,$index);
                    @endphp
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <input value="{{ $soal->jawaban }}" type="text" name="jawaban[]" class="form-control tanggal" id="datepicker-{{ $index }}">
                            </div>
                        </div>
                    </div>
                @break
                @case("table")
                    @php
                        array_push($temp_datepicker,$index);
                    @endphp
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <input type="hidden" name="id[]" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <input value="{{ $soal->jawaban }}" type="text" name="jawaban[]" class="form-control tanggal" id="datepicker-{{ $index }}">
                            </div>
                        </div>
                    </div>
                @break
                @default
            @endswitch
            @endforeach
        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="row">
                <div class="col-12 col-md-8">
                    <button type="submit" name="action" class="btn btn-warning" value="back">Back<span class="glyphicon glyphicon-send"></span></button>
                </div>
                <div class="col-6 col-md-4">
                    <button type="submit" name="action" class="btn btn-success" value="save">Next<span class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection