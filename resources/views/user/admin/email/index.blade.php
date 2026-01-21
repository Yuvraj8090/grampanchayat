@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-email.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Send Email</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:60px;">क्रमांक</th>
                            <th class="text-center" style="width:200px;">Send to</th>
                            <th class="text-center" style="width:200px;">Subject</th>
                            <th class="text-center" style="width:200px;">Message</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($email as $emails)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$emails->to}}</td>
                                <td>{{$emails->subject}}</td>
                                <td>{{$emails->msg}}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection