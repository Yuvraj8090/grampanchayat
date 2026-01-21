@extends('layouts.admin')

@section('content')

                
                <div class="table-responsive">
                    <h4>All Feedbacks : </h4> <br>
                    
                    <br/>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <strong> {{session('success')}}</strong>
                        </div><br/>
                    @endif
                    
                
                    <table @if(auth()->user()->role_id == 1) style="width:100%;" @endif  class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" >S.No</th>
                            <th class="text-center" > Name</th>
                            <th class="text-center" >Email </th>
                            <th class="text-center">Phone Number </th>
                            <th class="text-center" style="width:20%;" >Created At </th>
                            <th class="text-center"  >Operation</th>
                        </thead>
                        <tbody>
                        	<?php $i = 1; ?>
                           	@foreach($data as $key => $d)
                            <tr>
                               <td>{{ $key+ 1 }}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->email}}</td>
                                <td>{{$d->phone}}</td>
                                <td>{{date('d M, Y', strtotime($d->created_at))}}</td>
                                <td>
                        
                                    <a href="{{ url('/deletefeedback/'.$d->id) }}" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-trash"> Delete</i></a>
                                  
                                </td>
                            </tr>
                            <?php $i++; ?>
                           @endforeach
                        </tbody>
                    </table>
                </div>
@endsection