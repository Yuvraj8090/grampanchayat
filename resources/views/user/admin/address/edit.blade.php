@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-address.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($add, ['method'=>'PATCH', 'action'=>['UserAddress@update', $add->id]]) !!}

        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label>Address</label>
            <input type="text" name="address" value="{{$add->address}}" class="form-control" placeholder="Address" required="required">
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('map') ? ' has-error' : '' }}">
            <label>Map Link</label>
            <input type="text" name="map" value="{{$add->map}}" class="form-control" placeholder="Map Link" required="required">
            @if ($errors->has('map'))
                <span class="help-block">
                    <strong>{{ $errors->first('map') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection