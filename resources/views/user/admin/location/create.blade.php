@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-location.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserLocation@store']) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>विभाग का नाम:</label>
            <input type="text" name="name" value="{{ old('name')}}" class="form-control" required="required" placeholder="विभाग का नाम">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
            <label>पता:</label>
            <textarea rows="4" name="place" class="form-control" required="required">{{old('place')}}</textarea>
            @if ($errors->has('place'))
                <span class="help-block">
                    <strong>{{ $errors->first('place') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('distance') ? ' has-error' : '' }}">
            <label>दुरी (लगभग) :</label>
            <input type="text" name="distance" class="form-control" value="{{old('distance')}}" required="required" placeholder="दुरी (लगभग)">
            @if ($errors->has('distance'))
                <span class="help-block">
                    <strong>{{ $errors->first('distance') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection