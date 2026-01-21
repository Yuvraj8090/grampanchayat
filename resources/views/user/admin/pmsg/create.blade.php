@extends('layouts.admin')

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'.te' });</script>
<style type="text/css">
    #mceu_31
    {
        display:none!important;
    }
</style>
@section('content')
<br/>
<a href="{{route('user-p-message.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserPmsg@store', 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
            <label>Message</label>
            <input type="text" name="msg" value="{{ old('msg') }}" class="form-control te" style="min-height:400px;">
            @if ($errors->has('msg'))
                <span class="help-block">
                    <strong>{{ $errors->first('msg') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>Image</label>
            <input type="file" name="image">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection