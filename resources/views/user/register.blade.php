<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Register | Gram Panchayat</title>
<style type="text/css">
    label
    {
        margin-top:6px;
    }
</style>
@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                   @if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
                    <h2 style="margin:0px;">Registration Form</h2>
                    <hr/>

                   <form method="POST" action="{{ url('/resgister/store') }}" >
                       
                   <input type="hidden" name="token" value="{{ csrf_token() }}" >

                    <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Full Name" required="required">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('age') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Age</label>
                            <div class="col-md-9">
                                <input type="text" name="age" value="{{old('age')}}" class="form-control" placeholder="Age" required="required">
                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                     <div class="row{{ $errors->has('pin') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Date of Birth</label>
                            <div class="col-md-9">
                                <input type="date" name="dob" value="{{old('dob')}}" class="form-control" placeholder="DOB" required="required">
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    
                    <div class="row{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Phone Number</label>
                            <div class="col-md-9">
                                <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone Number" required="required">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required="required">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('pin') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Pin Code</label>
                            <div class="col-md-9">
                                <input type="number" name="pin" value="{{old('pin')}}" class="form-control" placeholder="Pin Code" required="required">
                                @if ($errors->has('pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('occupation') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Occupation</label>
                            <div class="col-md-9">
                                <select class="form-control" name="occupation" required="required">
                                    <option>{{old('occupation')}}</option>
                                    <option>Government Job</option>
                                    <option>Private Job</option>
                                    <option>Self-Employed</option>
                                    <option>Farmer</option>
                                </select>
                                @if ($errors->has('occupation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('occupation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('qualification') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Qualification</label>
                            <div class="col-md-9">
                                <select class="form-control" name="qualification" required="required">
                                    <option>{{old('qualification')}}</option>
                                    <option>Uneducated</option>
                                    <option>5th</option>
                                    <option>8th</option>
                                    <option>10th</option>
                                    <option>12th</option>
                                    <option>Graduate</option>
                                    <option>Post-Graduate</option>
                                </select>
                                @if ($errors->has('qualification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><br/>
                    <div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Stream</label>
                            <div class="col-md-9">
                                <select class="form-control" name="stream" required="required">
                                    <option>{{old('stream')}}</option>
                                    <option>Arts</option>
                                    <option>Commerce</option>
                                    <option>Science</option>
                                </select>
                                @if ($errors->has('stream'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stream') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">State</label>
                            <div class="col-md-9">
                                <select   data-url="{{ url('/disticts') }}" data-variable="district"  class="form-control element " name="state" required="required">
                                    @if(count($states) > 0)
                                        <option value="" >Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                            
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('stream'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stream') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">District</label>
                            <div class="col-md-9">
                                <select id="district"  data-url="{{ url('/blocks') }}"  data-variable="block"   class="form-control element" name="district" required="required">
                                    @if(count($states) > 0)
                                        <option value="" >Select District</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                            
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('stream'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stream') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label class="col-md-3">Block</label>
                            <div class="col-md-9">
                                <select id="block" class="form-control" name="block" required="required">
                                    @if(count($states) > 0)
                                        <option value="" >Select Block</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                            
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('stream'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stream') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <center><button class="btn btn-primary btn-sm">Submit</button></center>
                    </div>
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        

@endsection

@section('script')
<script>
$(".element").on("change", function (event) {

    var state_id = $(this).val();
    var url = $(this).data('url');
    var typeVar = $(this).data('variable');
    
    console.log('working');

    $.ajax({
        url: url,
        type: "GET",
        data: {id:state_id},
        success: function (response) {
            $('#city').removeAttr('disabled');
            if (response.data) {
                var selectElement = $('#'+typeVar);
                
                // Clear any existing options
                selectElement.empty();
                selectElement.append($('<option>', {
                    value: "",
                    text: "SELECT"
                }));
                // Append new options
                $.each(response.data, function (index, item) {
                    selectElement.append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
            }
        
        },
        error: function (err) {
            alert("Error! Please Contact Admin.");
        },
    });

});
</script>
@stop
