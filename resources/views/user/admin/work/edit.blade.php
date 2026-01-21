@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-work.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($work, ['method'=>'PATCH', 'action'=>['UserWork@update', $work->id], 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>कार्य का नाम:</label>
            <input type="text" name="name" class="form-control" value="{{$work->name}}" required="required" placeholder="कार्य का नाम">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
            <label>कार्य के बारेमे:</label>
            <textarea rows="4" name="about" class="form-control" required="required">{{$work->about}}</textarea>
            @if ($errors->has('about'))
                <span class="help-block">
                    <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('y_name') ? ' has-error' : '' }}">
            <label>योजना का नाम:</label>
            <input type="text" name="y_name" class="form-control" value="{{$work->y_name}}" required="required" placeholder="योजना का नाम">
            @if ($errors->has('y_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('y_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
            <label>वर्ष:</label>
            <input type="text" name="year" class="form-control" value="{{$work->year}}" required="required" placeholder="वर्ष">
            @if ($errors->has('year'))
                <span class="help-block">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label>राशि:</label>
            <input type="text" name="price" class="form-control" value="{{$work->price}}" required="required" placeholder="राशि">
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
            <label>स्तीथि:</label>
            <select name="place" class="form-control" required="required">
                <option>{{$work->place}}</option>
                <option>प्रगतिशील</option>
                <option>पूर्ण</option>
            </select>
            @if ($errors->has('place'))
                <span class="help-block">
                    <strong>{{ $errors->first('place') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   <img src="/images/{{$work->oldimage}}" class="img-responsive" style="width:100px;height:100px;">
                </div>
                <div class="form-group{{ $errors->has('oldimage') ? ' has-error' : '' }}">
                    <label>पुराणी फोटो:</label>
                    <input type="file" name="oldimage">
                    @if ($errors->has('oldimage'))
                    <span class="help-block">
                        <strong>{{ $errors->first('oldimage') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <img src="/images/{{$work->newimage}}" class="img-responsive" style="width:100px;height:100px;">
                </div>
                <div class="form-group{{ $errors->has('newimage') ? ' has-error' : '' }}">
                    <label>नए फोटो:</label>
                    <input type="file" name="newimage">
                    @if ($errors->has('newimage'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newimage') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection