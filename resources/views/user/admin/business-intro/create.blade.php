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
<a href="{{route('user-business-intro.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserBusinessIntro@store']) !!}

        <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
            <label>About</label>
            <input type="text" name="intro" class="form-control te" value="{{old('intro')}}" style="min-height:400px;">
            @if ($errors->has('intro'))
                <span class="help-block">
                    <strong>{{ $errors->first('intro') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection