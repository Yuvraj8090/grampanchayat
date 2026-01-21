@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-places.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserPlaces@store', 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>नाम:</label>
            <input type="text" name="name" value="{{ old('name')}}" class="form-control" required="required" placeholder="नाम">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
            <label>बारे में:</label>
            <textarea rows="4" name="about" class="form-control" required="required">{{old('about')}}</textarea>
            @if ($errors->has('about'))
                <span class="help-block">
                    <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>Image</label>
            <input type="file" name="image" required="required">
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