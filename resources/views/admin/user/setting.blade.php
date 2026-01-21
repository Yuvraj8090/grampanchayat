@extends('layouts.admin')

@section('content')
<br />

<div class="container">
    
    
    <a href="{{route('admin-user.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go
        Back</a>
    <br /><br />
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('/change/password') }}" method="POST" > 
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
        <label for="current_password" class="col-md-4 control-label">Current Password</label>

        <div class="col-md-6">
            <input id="current_password" type="text" class="form-control" name="current_password"
                value="{{ old('current_password') }}"  autofocus placeholder="Current Password">

            @if ($errors->has('current_password'))
            <span class="help-block">
                <strong>{{ $errors->first('current_password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br /><br />

    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
        <label for="new_password" class="col-md-4 control-label">New Password</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="new_password" value="{{ old('new_password') }}" 
                placeholder="New Password">

            @if ($errors->has('new_password'))
            <span class="help-block">
                <strong>{{ $errors->first('new_password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br />
    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
        <label for="confirm_password" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="confirm_password" type="text" class="form-control" name="confirm_password" 
                placeholder="Confirm Password">

            @if ($errors->has('confirm_password'))
            <span class="help-block">
                <strong>{{ $errors->first('confirm_password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br />


    `<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>

@endsection