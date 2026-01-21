@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-address.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::open(['method'=>'POST', 'action'=>'UserAddress@store']) !!}

        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address" required="required">
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('map') ? ' has-error' : '' }}">
            <label>Map</label>
            <input type="text" name="map" class="form-control" placeholder="Map Link" required="required">
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