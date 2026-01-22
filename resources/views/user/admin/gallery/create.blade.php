@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <br />
    <a href="{{ route('user-gallery.index') }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go
        Back</a>
    <br /><br />
    <div class="container">

        <form method="POST" action="{{ route('user-gallery.store') }}"
            enctype="multipart/form-data>
        @csrf
        @method('POST')


        <div class="form-group{{ $errors->has('image_name') ? ' has-error' : '' }}">
            <label>Image Name</label>
            <input type="text" name="image_name" class="form-control" required="required" placeholder="Image Name">
            @if ($errors->has('image_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('image_name') }}</strong>
                </span>
            @endif
    </div>
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label>Choose Image</label>
        <input type="file" name="image" required="required" id="upload">
        @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <center><button class="btn btn-success btn-sm">Submit</button></center>
    </div>

    </form>
    </div>
@endsection
