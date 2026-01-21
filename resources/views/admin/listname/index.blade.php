@extends('layouts.admin')

@section('content')
<style>
    .card {
        margin: 10px;
        border: 1px solid black;
        padding: 10px 10px;
    }
</style>
<br />
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


<div class="table-responsive">

    <div style="padding-left:50px;" >
        <a class="btn bt-md btn-primary" href="{{ route('jan-partinidhi.create') }}">Add </a>
        <a class="btn bt-md btn-primary" href="{{ url('jan-partinidhi/excelUpload') }}">Add By Excel</a>
        <br><br>
        
        <form action="" method="GET" > 
        <div class="row">
            <div class="col-md-10">
               <div class="form-group">
            <label for="email">Search By Panchayat:</label>
            <select name="search" class="form-control">
                <option value="" >Select</option>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if(request()->search == $user->id) selected @endif > {{ $user->name ,$user->hindi }} </option>
                    @endforeach
                @endif
            </select>
          </div>
            </div>
            <div class="col-md-1">
                
                <div class="form-group">
                    
                   <button style="margin-top:22px;" class="btn btn-success btn-md" >Search</button>
                </div>
            </div>
        </div>
        </form>
    </div>
   

    <table class="table table-bordered table-striped">
        <thead>
            <th class="text-center" style="width:40px;">S.No</th>
            <th class="text-center" style="width:120px;">Panchayat</th>
            <th class="text-center" style="width:120px;">Name</th>
            <th class="text-center" style="width:120px;">Position</th>
            <th class="text-center" style="width:120px;">Block</th>
            <th class="text-center" style="width:120px;">Phone</th>
            <th class="text-center" style="width:100px;">Created Date</th>
            <th class="text-center" style="width:120px;">Operation</th>
        </thead>

        <tbody>
            @if(count($data) > 0)
            @foreach($data as $key => $d)
            <tr>
                <td>{{ $data->firstItem() + $key }}</td>
                <td>{{ $d->user->name }} <br>{{ $d->user->hindi }} </td>

                <td>{{ $d->name }} </td>
                <td>{{ $d->position }} </td>
                <td>{{ $d->block }} </td>
                <td>{{ $d->phone }} </td>
                <td style="font-size:15px;" >{{ date("d,M Y",strtotime($d->created_at)) }} </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('jan-partinidhi.edit',$d->id) }}">Edit</a>
                    <a class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')" href="{{ url('jan-partinidhi/delete/'.$d->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div style="padding-left:50px;">
        {{ $data->links()}}
    </div>
</div>
@endsection