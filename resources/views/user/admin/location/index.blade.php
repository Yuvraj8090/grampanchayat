@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-location.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add</a>
    <br/><br/>
 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:150px;">विभाग का नाम</th>
                            <th class="text-center" style="width:200px;">पता</th>
                            <th class="text-center" style="width:80px;">दुरी (लगभग) </th>
                            <th class="text-center" style="width:100px;">Operation</th>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                            @foreach($lo as $loc)
                            <tr>
                                
                                <td>{{$i}}</td>
                                <td>{{$loc->name}}</td>
                                <td>{{$loc->place}}</td>
                                <td>{{$loc->distance}}</td>
                                <td>
                                    <a href="{{route('user-location.edit', $loc->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                   
                                    <form action={{ route('user-location.destroy', $loc->id) }} method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs pull-left" style="margin-left:10px;"><i class="fa fa-trash"> Delete</i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection