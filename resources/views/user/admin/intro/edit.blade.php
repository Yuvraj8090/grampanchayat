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
<a href="{{route('user-introduction.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($intro, ['method'=>'PATCH', 'action'=>['UserIntro@update', $intro->id]]) !!}

        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
            <label>Introduction</label>
            <input type="text" name="introduction" value="{{$intro->intro}}" class="form-control te" style="min-height:400px;">
            @if ($errors->has('introduction'))
                <span class="help-block">
                    <strong>{{ $errors->first('introduction') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection