@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-facts.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:60px;">क्रमांक</th>
                            <th class="text-center" style="width:200px;">मुख्य तथ्य</th>
                            <th class="text-center" style="width:200px;">संख्या</th>
                            <th class="text-center" style="width:60px;">Operation</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($fact as $facts)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$facts->fact}}</td>
                                <td>{{$facts->num}}</td>
                                <td>
                                    <a href="{{route('user-facts.edit', $facts->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['UserFact@destroy', $facts->id]]) !!}
                                        <button class="btn btn-danger btn-xs pull-left" style="margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection