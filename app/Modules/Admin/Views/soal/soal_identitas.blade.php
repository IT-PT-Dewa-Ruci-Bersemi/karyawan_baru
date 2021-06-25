@extends('admin::templates.master')


@section('content')
<div class="container">
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset>
            <!-- Form Name -->
            <legend><h2><b> {{ $grup->grup }} </b></h2></legend><br>
            @foreach ($soals as $soal)
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