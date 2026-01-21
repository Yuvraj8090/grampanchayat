@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('admin-user.index')}}" class="btn btn-primary btn-md"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
     <a href="{{asset('excel/Jantpath_nidhi_upload_sheet.xlsx')}}" class="btn btn-primary pull-right btn-md" download="example.xlsx"> Download Sample Excel Sheet </a>
    <br><br>


    @if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br />
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <form action="{{ url('jan-partinidhi/excel/upload')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="form-group">
            <label for="exampleInputPassword1"> Excel File :</label>
            <input type="file" name="file" class="form-control" id="exampleInputPassword1"
            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
            placeholder="Excel File">
            @if ($errors->has('file'))
            <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection