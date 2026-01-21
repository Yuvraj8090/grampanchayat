@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-video.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($video, ['method'=>'PATCH', 'action'=>['UserVideo@update', $video->id]]) !!}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label>Title</label>
            <input type="text" name="title" value="{{$video->title}}" class="form-control" required="required" placeholder="Title">
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label>Youtube link id</label>
            <input type="text" name="url" value="{{$video->url}}" class="form-control" required="required" placeholder="Youtube link id">
            @if ($errors->has('url'))
                <span class="help-block">
                    <strong>{{ $errors->first('url') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
            <label>About</label>
            <textarea rows="4" name="about" class="form-control" required="required">{{$video->about}}</textarea>
            @if ($errors->has('about'))
                <span class="help-block">
                    <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection