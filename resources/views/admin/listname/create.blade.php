@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('admin-user.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>

    <br><br>
    <form action="{{ route('jan-partinidhi.store') }}" method="POST">

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
            <label for="exampleInputEmail1">Name : </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}" placeholder="Enter Name">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Position :</label>
            <select class="form-control" name="position">
                <option value="">Select </option>
                @if(count($positions) > 0)
                @foreach($positions as $po)
                <option value="{{ $po->name }}" > {{ $po->name }}</option>
                @endforeach
                @endif
            </select>
                @if ($errors->has('position'))
                <span class="help-block">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
                @endif
            
            
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Phone No. :</label>
            <input type="number" name="phone" class="form-control" id="exampleInputPassword1" value="{{old('phone') }}" placeholder="Phone No.">
            @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Block:</label>
            <input type="text" name="block" class="form-control" id="exampleInputPassword1" value="{{ old('block') }}" placeholder="Phone No.">
            @if ($errors->has('block'))
            <span class="help-block">
                <strong>{{ $errors->first('block') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection