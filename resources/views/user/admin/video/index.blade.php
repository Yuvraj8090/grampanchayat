@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-video.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add Video</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:100px;">Title</th>
                            <th class="text-center" style="width:200px;">Video</th>
                            <th class="text-center" style="width:200px;">About</th>
                            <th class="text-center" style="width:80px;">Operation</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                        @foreach($video as $videos)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$videos->title}}</td>
                                <td><iframe width="100" height="100" src="https://www.youtube.com/embed/{{$videos->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                                <td>{{$videos->about}}</td>
                                <td>
                                    <a href="{{route('user-video.edit', $videos->id)}}" class="btn btn-success btn-xs pull-left"><i class="fa fa-edit"></i> Edit</a>
                                    <form method="POST" action="{{ route('user-video.destroy',$videos->id) }}">
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