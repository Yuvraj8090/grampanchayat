@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-danger">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-email.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserEmail@store', 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
            <label>Send to</label>
            <input type="email" name="to" value="{{ old('to')}}" class="form-control" required="required" placeholder="Send to">
            @if ($errors->has('to'))
                <span class="help-block">
                    <strong>{{ $errors->first('to') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
            <label>Subject</label>
           <input type="text" name="subject" placeholder="Subject" class="form-control" required="required">
            @if ($errors->has('subject'))
                <span class="help-block">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
            @endif
        </div>
         <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label>Attach file</label>
            <input type="file" name="file">
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label>Message</label>
            <textarea rows="4" class="form-control" name="message" required="required" placeholder="Type here"></textarea>
            @if ($errors->has('message'))
                <span class="help-block">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
        </div>
       
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection