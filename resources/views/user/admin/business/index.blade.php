@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-business.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add</a>
    <br/><br/>
 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:100px;">Image</th>
                            <th class="text-center" style="width:150px;">ग्राम्य व्यवसाय </th>
                            <th class="text-center" style="width:200px;">बारे में </th>
                            <th class="text-center" style="width:80px;">Operation</th>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                            @foreach($place as $places)
                            <tr>
                                
                                <td>{{$i}}</td>
                                <td><center><img src="/images/{{$places->image}}" class="img-responsive" style="width:100px;height:100px;"></center></td>
                                <td>{{$places->name}}</td>
                                <td>{{$places->about}}</td>
                                <td>
                                    <a href="{{route('user-business.edit', $places->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                   
                                    <form method="POST" action="{{ route('user-business.destroy',$places->id) }}">
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