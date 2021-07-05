@extends('admin::templates.master')


@section('content')
<div class="container">
    <form class="well form-horizontal" action="" method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <legend><h2><b> {{ $grup->grup }} </b></h2></legend><br>
            @foreach ($soals as $soal)
            @switch($soal->type)
                @case("input")
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" value="{{$soal->id}}" >
                            <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                        </div>
                        <div class="col-md-6">
                            <input name="jawaban" placeholder="{{ $soal->soal }}" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                    @break
                @case("textarea")
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" value="{{$soal->id}}" >
                            <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                        </div>
                        <div class="col-md-6">
                            <textarea id="jawaban" name="jawaban" placeholder="{{ $soal->soal }}" class="form-control">
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
                                <input type="hidden" name="id" value="{{$soal->id}}" >
                                <label class="col-md-6 control-label" >{{ $soal->soal }}</label>
                            </div>
                            <div class="col-md-6">
                                <select name="jawaban" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    @foreach ($options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @php
                        skip:
                    @endphp
                        @break
                @default
                    
            @endswitch
            @endforeach
            
            
            <!-- Select Basic -->
            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">Success 
                <i class="glyphicon glyphicon-thumbs-up">
                </i> Success!.
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="row">
                <div class="col-12 col-md-8">
                    <button type="submit" name="action" class="btn btn-warning" value="back">Previous<span class="glyphicon glyphicon-send"></span></button>
                </div>
                <div class="col-6 col-md-4">
                    <div class="float-right">
                        <button type="submit" name="action" class="btn btn-success" value="save">Next<span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>
            </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection