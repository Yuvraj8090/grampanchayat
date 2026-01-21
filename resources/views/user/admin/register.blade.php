@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('dashboard.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:40px;">क्रमांक</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center" >Email</th>
                            <th class="text-center">Pin Code</th>
                            <th class="text-center">Occupation</th>
                            <th class="text-center">Qualification</th>
                            <th class="text-center">Stream</th>
                            <th class="text-center">On</th>
                            <th class="text-center" style="width:100px;">Operation</th>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                            @foreach($re as $loc)
                            <tr>
                                
                                <td>{{$i}}</td>
                                <td>{{$loc->name}}</td>
                                <td>{{$loc->age}}</td>
                                <td>{{$loc->phone}}</td>
                                <td>{{$loc->email}}</td>
                                <td>{{$loc->pin}}</td>
                                <td>{{$loc->occupation}}</td>
                                <td>{{$loc->qualification}}</td>
                                <td>{{$loc->stream}}</td>
                                <td>{{date('d F, Y', strtotime($loc->created_at))}}</td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['UserRegister@destroy', $loc->id]]) !!}
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