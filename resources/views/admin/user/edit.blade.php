@extends('layouts.admin')

@section('content')
<br />
<a href="{{route('admin-user.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
<br /><br />
<div class="container">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUser@update', $user->id]]) !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Panchayat Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus placeholder="Panchayat Name">

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br /><br />

    <div class="form-group{{ $errors->has('hindi_name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Panchayat Name Hindi</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="hindi_name" value="{{$user->hindi}}" required placeholder="Panchayat Name Hindi">

            @if ($errors->has('hindi_name'))
            <span class="help-block">
                <strong>{{ $errors->first('hindi_name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br />
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required placeholder="E-Mail Address">

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <br /><br />
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone" class="col-md-4 control-label">Mobile Number</label>

        <div class="col-md-6">
            <input id="phone" type="number" class="form-control" name="phone" value="{{ $user->phone }}" required placeholder="Mobile Number">

            @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <br /><br />
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone" class="col-md-4 control-label">Google Webmaster Code</label>

        <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="google" value="{{ $user->google }}" required placeholder="Google Webmaster Code">

            @if ($errors->has('google'))
            <span class="help-block">
                <strong>{{ $errors->first('google') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <br /><br />
    
    
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">DOB</label>

                            <div class="col-md-6">
                                <input id="phone" type="date" class="form-control" name="dob" value="{{ old('dob') ?? $user->dob }}" required placeholder="DOB">

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <br/><br/>
                       
                         <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="password" value="{{ old('password') }}" required placeholder="Enter Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <br/><br/>
                        <div class="form-group{{ $errors->has('occupation') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Occupation ( Optional)</label>

                            <div class="col-md-6">
                                <input id="phone" type="texy" class="form-control" name="occupation" value="{{ old('occupation') ?? $user->occupation }}"  placeholder="occupation">

                                @if ($errors->has('occupation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('occupation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <br/><br/>
                       
                        <div class="form-group{{ $errors->has('qualification') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Qualification ( Optional)</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="qualification" value="{{ old('qualification') ?? $user->qualification }}"  placeholder="qualification">

                                @if ($errors->has('qualification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <br/><br/>
                       
                                     <div class="form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Stream ( Optional)</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="stream" value="{{ old('stream') ?? $user->stream }}"  placeholder="stream">

                                @if ($errors->has('stream'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stream') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <br/><br/>
                        


    <div class="form-group {{ $errors->has('stream') ? ' has-error' : '' }}">
        <div class="">
            <label class="col-md-4 control-label">State</label>
            <div class="col-md-6">
                <select data-url="{{ url('/disticts') }}" data-variable="district" class="form-control element " name="state" required="required">
                    @if(count($states) > 0)
                    <option value="">Select State</option>
                    @foreach($states as $state)
                    <option value="{{$state->id}}" @if($state->id == $user->state_id) selected @endif>{{$state->name}}</option>

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
    <br />    <br />
    
    


    <div class="form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
        <div class="">
            <label class="col-md-4 control-label">District</label>
            <div class="col-md-6">
                <select id="district" data-url="{{ url('/blocks') }}" data-variable="block" class="form-control element" name="district" required="required">

                    <option value="{{ $user->district_id ?? '' }}">{{ $user->district->name ?? 'Select Block' }}</option>


                </select>
                @if ($errors->has('stream'))
                <span class="help-block">
                    <strong>{{ $errors->first('stream') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <br />    <br />


    <div class="form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
        <div class="">
            <label class="col-md-4 control-label">Block</label>
            <div class="col-md-6">
                <select id="block" class="form-control" name="block" required="required">
                    <option value="{{ $user->block_id ?? '' }}">{{ $user->block->name ?? 'Select Block' }}</option>

                </select>
                @if ($errors->has('stream'))
                <span class="help-block">
                    <strong>{{ $errors->first('stream') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <br />    <br />

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>

@endsection

@section('script')
<script>
    $(".element").on("change", function(event) {

        var state_id = $(this).val();
        var url = $(this).data('url');
        var typeVar = $(this).data('variable');

        console.log('working');

        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: state_id
            },
            success: function(response) {
                $('#city').removeAttr('disabled');
                if (response.data) {
                    var selectElement = $('#' + typeVar);

                    // Clear any existing options
                    selectElement.empty();
                    selectElement.append($('<option>', {
                        value: "",
                        text: "SELECT"
                    }));
                    // Append new options
                    $.each(response.data, function(index, item) {
                        selectElement.append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                }

            },
            error: function(err) {
                alert("Error! Please Contact Admin.");
            },
        });

    });
</script>
@stop