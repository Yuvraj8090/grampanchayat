@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-list.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add</a>
    <br/><br/>
 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:150px;">नाम </th>
                            <th class="text-center" style="width:200px;">पद</th>
                            <th class="text-center" style="width:80px;">वार्ड </th>
                            <th class="text-center" style="width:80px;">फ़ोन नंबर</th>
                            <th class="text-center" style="width:100px;">Operation</th>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                            @foreach($list as $list)
                            <tr>
                                
                                <td>{{$i}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->position}}</td>
                                <td>{{$list->block}}</td>
                                <td>{{$list->phone}}</td>
                                <td>
                                    <a href="{{route('user-list.edit', $list->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['UserList@destroy', $list->id]]) !!}
                                        <button class="btn btn-danger btn-xs pull-left" style="margin-left:10px;"><i class="fa fa-trash"> Delete</i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection