@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-edit"></i> Edit Fact (तथ्य सुधारें)</h3>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Update Details
        <div class="pull-right">
            <a href="{{ route('user-facts.index') }}" class="btn btn-primary btn-xs" style="margin-top: -5px;">
                <i class="fa fa-arrow-left fa-fw"></i> Back
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                
                {{-- Modern HTML Form with Blade Directives --}}
                <form action="{{ route('user-facts.update', $fact->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- Fact Input --}}
                    <div class="form-group @error('facts') has-error @enderror">
                        <label for="facts">मुख्य तथ्य (Fact)</label>
                        <input type="text" 
                               name="facts" 
                               id="facts" 
                               class="form-control" 
                               value="{{ old('facts', $fact->fact) }}" 
                               placeholder="Enter main fact" 
                               required>
                        
                        @error('facts')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Number Input --}}
                    <div class="form-group @error('number') has-error @enderror">
                        <label for="number">संख्या (Count/Number)</label>
                        <input type="number" 
                               name="number" 
                               id="number" 
                               class="form-control" 
                               value="{{ old('number', $fact->num) }}" 
                               placeholder="Enter number" 
                               required>

                        @error('number')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br>
                    
                    {{-- Submit Button --}}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection