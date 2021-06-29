@extends('admin::templates.master')


@section('content')
<div class="container">
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <legend><h2><b> {{ $grup->grup }} </b></h2></legend><br>
            @foreach ($soals as $soal)
            @switch($soal->type)
                @case("input")
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-4">
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
            

            <div class="form-group"> 
                <label class="col-md-4 control-label">Department / Office</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="department" class="form-control selectpicker">
                            <option value="">Select your Department/Office</option>
                            <option>Department of Engineering</option>
                            <option>Department of Agriculture</option>
                            <option>Accounting Office</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Select Basic -->
            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">Success 
                <i class="glyphicon glyphicon-thumbs-up">
                </i> Success!.
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection