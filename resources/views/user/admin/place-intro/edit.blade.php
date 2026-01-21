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
<a href="{{route('user-places-intro.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($add, ['method'=>'PATCH', 'action'=>['UserPlacesIntro@update', $add->id]]) !!}

        <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
            <label>About</label>
            <input type="text" name="intro" value="{{$add->intro}}" class="form-control te" style="min-height:400px;">
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