@extends('layouts.admin')

@section('content')
<style>
    .card {
        margin: 10px;
        border: 1px solid black;
        padding: 10px 10px;
    }

    label {
        margin-top: 10px !important;
    }
</style>
<br />
@if(Session::has('insert'))
<div class="alert alert-success">
    <strong> {{session('insert')}}</strong>
</div><br />
@endif



<div style="margin:10px 50px;">
    <div class="card">
        <div class="card-header">
            <h4>Add </h4>
        </div>
        <div class="card-body">

            @if(isset($add->title))

            <form action="{{ route('important.update',$add->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @else
                <form action="{{ route('important.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @endif
                    <lable>Title: </lable>
                    <input type="textbox" class="form-control" name="title"
                        value="{{ $add->title ?? request()->title ?? '' }}" />
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif

                    <lable>Link text: </lable>
                    <input type="textbox" class="form-control" name="link_title"
                        value="{{ $add->link_title ?? request()->link_title ?? '' }}" />
                    @if ($errors->has('link_title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link_title') }}</strong>
                    </span>
                    @endif

                    <lable>Link url: </lable>
                    <input type="url" class="form-control" name="link"
                        value="{{ $add->link ?? request()->link ?? '' }}" />
                    @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
        </div>
    </div> <br />

    <div class="table-responsive">
        <table style="width:100%;" class="table table-bordered table-striped">
            <thead>
                <th class="text-center" style="width:40px;">S.No</th>
                <th class="text-center" style="width:120px;">Point</th>
                <th class="text-center" style="width:120px;">Link</th>

                <th class="text-center" style="width:100px;">Created Date</th>
                <th class="text-center" style="width:120px;">Operation</th>
            </thead>

            <tbody>
                @if(count($data) > 0)
                @foreach($data as $key => $d)
                <tr>
                    <td>{{ $data->firstItem() + $key }}</td>
                    <td>{{ $d->title }} </td>
                    <td> <a target="_blank" href="{{ $d->link }}">{{ $d->link_title }}</a> </td>
                    <td>{{ date("d,M Y h:i A",strtotime($d->created_at)) }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('important.index') }}?id={{$d->id}}">Edit</a>
                        <a class="btn btn-danger btn-sm" onClick-"return confirm('Are you sure ?')"
                            href="{{ url('important/delete/'.$d->id) }}">Delete</a>
                        <a class="btn btn-primary btn-sm" href="{{ url('points/index/'.$d->id) }}">Add Points</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $data->links() }}
</div>
@endsection