@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('admin-user.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>

    <br><br>
    <form action="{{ route('bravee.store') }}" method="POST" enctype="multipart/form-data" >

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="form-group">
            <label for="exampleInputEmail1">Select Grampanchayat : </label>
            <select class="form-control" name="user">
                <option value="">Select </option>
                @if(count($users) > 0)
                @foreach($users as $user)
                <option value="{{ $user->id }}" > {{ $user->name }}</option>
                @endforeach
                @endif
            </select>
            @if ($errors->has('user'))
            <span class="help-block">
                <strong>{{ $errors->first('user') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Image : </label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" value="{{ old('image') }}" >
            @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Name : </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}" placeholder="Enter Name">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Award :</label>
            <input type="text" name="award" class="form-control" id="exampleInputPassword1" value="{{old('award') }}" placeholder="Award">
            @if ($errors->has('award'))
            <span class="help-block">
                <strong>{{ $errors->first('award') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">reason:</label>
            <input type="reason" name="reason" class="form-control" id="exampleInputPassword1" value="{{ old('reason') }}" placeholder="Reason">
            @if ($errors->has('reason'))
            <span class="help-block">
                <strong>{{ $errors->first('reason') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">About:</label>
            <textarea rows="5" type="reason" name="about" class="form-control" id="exampleInputPassword1" value="{{ old('reason') }}" placeholder="About.."></textarea>
            @if ($errors->has('about'))
            <span class="help-block">
                <strong>{{ $errors->first('about') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection