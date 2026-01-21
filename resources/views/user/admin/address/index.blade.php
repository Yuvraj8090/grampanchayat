@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-address.create')}}" class="btn btn-primary btn-xs band"><i class="fa fa-plus fa-fw"></i> Add</a>
    <br/><br/>
 
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                           
                            <th class="text-center" style="width:200px;">पता</th>
                            <th class="text-center" style="width:100px;">Operation</th>
                        </thead>
                        <tbody>
                           
                            @foreach($add as $address)
                            <tr>
                                
                                <td>{{$address->address}}</td>
                                <td>
                                    <a href="{{route('user-address.edit', $address->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                            <style type="text/css">.band{display:none;}</style>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            
                
@endsection