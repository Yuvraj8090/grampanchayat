@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <a href="{{ route('admin-user.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left fa-fw"></i> Go Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{-- Standard HTML Form with Route --}}
            <form action="{{ action('AdminUser@update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Panchayat Name --}}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Panchayat Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" 
                               value="{{ old('name', $user->name) }}" required autofocus placeholder="Panchayat Name">
                        @error('name')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Panchayat Name Hindi --}}
                <div class="form-group {{ $errors->has('hindi_name') ? 'has-error' : '' }}">
                    <label for="hindi_name" class="col-md-4 control-label">Panchayat Name Hindi</label>
                    <div class="col-md-6">
                        <input id="hindi_name" type="text" class="form-control" name="hindi_name" 
                               value="{{ old('hindi_name', $user->hindi) }}" required placeholder="Panchayat Name Hindi">
                        @error('hindi_name')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" 
                               value="{{ old('email', $user->email) }}" required placeholder="E-Mail Address">
                        @error('email')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Mobile Number --}}
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Mobile Number</label>
                    <div class="col-md-6">
                        <input id="phone" type="number" class="form-control" name="phone" 
                               value="{{ old('phone', $user->phone) }}" required placeholder="Mobile Number">
                        @error('phone')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Google Webmaster Code --}}
                <div class="form-group {{ $errors->has('google') ? 'has-error' : '' }}">
                    <label for="google" class="col-md-4 control-label">Google Webmaster Code</label>
                    <div class="col-md-6">
                        <input id="google" type="text" class="form-control" name="google" 
                               value="{{ old('google', $user->google) }}" required placeholder="Google Webmaster Code">
                        @error('google')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- DOB --}}
                <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                    <label for="dob" class="col-md-4 control-label">DOB</label>
                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control" name="dob" 
                               value="{{ old('dob', $user->dob) }}" required>
                        @error('dob')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        {{-- Note: Password fields should usually not be 'required' on update unless changing it is mandatory --}}
                        <input id="password" type="text" class="form-control" name="password" 
                               value="" placeholder="Enter New Password">
                        @error('password')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Occupation --}}
                <div class="form-group {{ $errors->has('occupation') ? 'has-error' : '' }}">
                    <label for="occupation" class="col-md-4 control-label">Occupation (Optional)</label>
                    <div class="col-md-6">
                        <input id="occupation" type="text" class="form-control" name="occupation" 
                               value="{{ old('occupation', $user->occupation) }}" placeholder="Occupation">
                        @error('occupation')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Qualification --}}
                <div class="form-group {{ $errors->has('qualification') ? 'has-error' : '' }}">
                    <label for="qualification" class="col-md-4 control-label">Qualification (Optional)</label>
                    <div class="col-md-6">
                        <input id="qualification" type="text" class="form-control" name="qualification" 
                               value="{{ old('qualification', $user->qualification) }}" placeholder="Qualification">
                        @error('qualification')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Stream --}}
                <div class="form-group {{ $errors->has('stream') ? 'has-error' : '' }}">
                    <label for="stream" class="col-md-4 control-label">Stream (Optional)</label>
                    <div class="col-md-6">
                        <input id="stream" type="text" class="form-control" name="stream" 
                               value="{{ old('stream', $user->stream) }}" placeholder="Stream">
                        @error('stream')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- State Select --}}
                <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                    <label for="state" class="col-md-4 control-label">State</label>
                    <div class="col-md-6">
                        <select id="state" data-url="{{ url('/disticts') }}" data-variable="district" class="form-control element" name="state" required>
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" 
                                    {{ (old('state', $user->state_id) == $state->id) ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('state')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- District Select --}}
                <div class="form-group {{ $errors->has('district') ? 'has-error' : '' }}">
                    <label for="district" class="col-md-4 control-label">District</label>
                    <div class="col-md-6">
                        <select id="district" data-url="{{ url('/blocks') }}" data-variable="block" class="form-control element" name="district" required>
                            {{-- Pre-load existing district if available --}}
                            @if($user->district_id)
                                <option value="{{ $user->district_id }}" selected>{{ $user->district->name ?? 'Select District' }}</option>
                            @else
                                <option value="">Select State First</option>
                            @endif
                        </select>
                        @error('district')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Block Select --}}
                <div class="form-group {{ $errors->has('block') ? 'has-error' : '' }}">
                    <label for="block" class="col-md-4 control-label">Block</label>
                    <div class="col-md-6">
                        <select id="block" class="form-control" name="block" required>
                            @if($user->block_id)
                                <option value="{{ $user->block_id }}" selected>{{ $user->block->name ?? 'Select Block' }}</option>
                            @else
                                <option value="">Select District First</option>
                            @endif
                        </select>
                        @error('block')
                            <span class="help-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".element").on("change", function(event) {
            var id = $(this).val();
            var url = $(this).data('url');
            var targetId = $(this).data('variable'); // The ID of the select to update (e.g., 'district' or 'block')

            if(id) {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: { id: id },
                    success: function(response) {
                        if (response.data) {
                            var $targetSelect = $('#' + targetId);
                            
                            // Clear existing options
                            $targetSelect.empty();
                            $targetSelect.append('<option value="">Select Option</option>');

                            // Append new options
                            $.each(response.data, function(index, item) {
                                $targetSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert("Error fetching data. Please contact admin.");
                    }
                });
            } else {
                // If they selected "Select State" (empty value), clear the children dropdowns
                var targetId = $(this).data('variable');
                $('#' + targetId).empty().append('<option value="">Select Previous Option First</option>');
            }
        });
    });
</script>
@stop