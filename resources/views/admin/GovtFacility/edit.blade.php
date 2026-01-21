@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('govtfacility.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>

    <br><br>
    <form action="{{ url('govtfacility/update/'.$data->id) }}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"  />


        <div class="form-group">
            <label for="exampleInputEmail1">Name : </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $data->title }}" placeholder="Enter Name">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Image : </label><br>
            <img src="{{ $data->image }}" height="200px" width="300px"  />
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" value="{{ old('image') }}" >
            @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
            @endif
        </div>


     
        
        <div class="form-group">
            <label for="exampleInputPassword1">About:</label>
            <textarea rows="5" name="description" class="form-control" id="exampleInputPassword1" placeholder="description..">{{ old('description') ?? $data->description }}</textarea>
            @if ($errors->has('about'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
        



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection