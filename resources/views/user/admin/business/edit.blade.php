@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-business.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($place, ['method'=>'PATCH', 'action'=>['UserBusiness@update', $place->id], 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>नाम:</label>
            <input type="text" name="name" value="{{$place->name}}" class="form-control" required="required" placeholder="नाम">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
            <label>बारे में:</label>
            <textarea rows="4" name="about" class="form-control" required="required">{{$place->about}}</textarea>
            @if ($errors->has('about'))
                <span class="help-block">
                    <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <img src="/images/{{$place->image}}" class="img-responsive" style="width:100px;height:100px;">
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