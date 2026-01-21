@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('govtfacility.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>

    <br><br>
    <form action="{{ route('govtfacility.store') }}" method="POST" enctype="multipart/form-data" >

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

       
        
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
            <label for="exampleInputPassword1">Description:</label>
            <textarea rows="5" type="text" name="description" class="form-control" id="exampleInputPassword1" value="{{ old('description') }}" placeholder="description.."></textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection