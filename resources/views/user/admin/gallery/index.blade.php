@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-gallery.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add Images</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:80px;">क्रमांक</th>
                            <th class="text-center" style="width:200px;">Image</th>
                            <th class="text-center">Image Name</th>
                            <th class="text-center" style="width:140px;">Operation</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                        @foreach($photo as $photos)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <center><img src="/images/{{$photos->image}}" class="img-responsive"style="width:80px;height:80px;"></center>
                                </td>
                                <td>{{$photos->alt}}</td>
                                <td>
<form method="POST" action="{{ route('user-gallery.destroy',$photos->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
</form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection