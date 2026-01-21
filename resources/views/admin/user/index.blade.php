@extends('layouts.admin')

@section('content')

<br />
@if(Session::has('insert'))
<div class="alert alert-success">
    <strong> {{session('insert')}}</strong>
</div><br />
@endif

<a style="padding-left:10px;" href="{{route('admin-user.create')}}" class="btn btn-primary btn-md">
<i class="fa fa-plus fa-fw"></i> Add Panchayat</a>
<a style="padding-left:10px;" href="{{url('/panchayat/excel')}}" class="btn btn-primary btn-md">
<i class="fa fa-plus fa-fw"></i> Add Panchayats By Excel</a>

<br><br>
<form action="" method="GET">
    <div class="form-group">
        <input type="text" name="search" placeholder="search by name" value="{{ request()->search ?? '' }}" class="form-control" />
    </div>
     <div class="form-group">
        <button class="btn btn-md btn-primary" >Submit</button>
        <a class="btn btn-md btn-danger" href="{{ route('admin-user.index') }}">Refresh</a>
    </div>
</form>
<div class="table-responsive">
    <table @if(auth()->user()->role_id == 1) style="width:100%;" @endif class="table table-bordered table-striped">
        <thead>
            <th class="text-center">S.No</th>
            <th class="text-center">ID</th>
            <th class="text-center">Panchayat Name</th>
            <th class="text-center">Hindi Name</th>
            <th class="text-center">Email </th>
            <th class="text-center">Password </th>
            <th class="text-center">Phone Number </th>
            <th class="text-center">Action</th>
            <th class="text-center" style="width:10%;">Created At </th>
            <th class="text-center" style="width:15%;">Operation</th>
        </thead>
        <tbody>
            @if(count($user) > 0)
                <?php $i = 1; ?>
                @foreach($user as $users)
                <tr>
                    <td>{{$i}}.</td>
                    <td>{{ $users->id }}</td>
                    <td><a href="http://{{$users->slug}}.grampanchayat.org" target="_blank">{{$users->name}}</a></td>
                    <td>{{$users->hindi}}</td>
                    <td>{{$users->email}}</td>
                    <td>{{$users->d_password ?? NULL }}</td>

                    <td>{{$users->phone}}</td>
                    <td><a href="{{route('admin-user.show', $users->id)}}" target="_blank"><i class="fa fa-sign-in fa-fw"></i> Login</a></td>
                    <td>{{date('d M, Y', strtotime($users->created_at))}}</td>
                    <td>
                        <a href="{{route('admin-user.edit', $users->id)}}" class="btn btn-success btn-sm pull-left">
                            <i class="fa fa-edit"></i> Edit</a>
                       <form method="POST" action="{{ route('admin-user.destroy', $users->id) }}" style="display:inline">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
        Delete
    </button>
</form>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            @else
            <tr>
                <td colspan="9">No data found</td>
            </tr>
            @endif
        </tbody>
    </table>
    {{ $user->links() }}
</div>
@endsection