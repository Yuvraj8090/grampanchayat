@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-work.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add Video</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:150px;">कार्य का नाम</th>
                            <th class="text-center" style="width:300px;">कार्य के बारेमे </th>
                            <th class="text-center" style="width:150px;">योजना का नाम</th>
                            <th class="text-center" style="width:100px;">वर्ष दिनक</th>
                            <th class="text-center" style="width:80px;">राशि</th>
                            <th class="text-center" style="width:80px;">स्तीथि</th>
                            <th class="text-center" style="width:150px;">Operation</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                        @foreach($work as $works)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$works->name}}</td>
                                <td>{{$works->about}}</td>
                                <td>{{$works->y_name}}</td>
                                <td>{{$works->year}}</td>
                                <td>{{$works->price}}</td>
                                <td>{{$works->place}}</td>
                                <td>
                                    <a href="{{route('user-work.edit', $works->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                   
                                    <form action="{{ route('user-work.destroy',$works->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs pull-left" style="margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection