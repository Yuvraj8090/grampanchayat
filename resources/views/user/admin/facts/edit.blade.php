@extends('layouts.admin')

@section('content')
<br/>
<a href="{{route('user-facts.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($fact, ['method'=>'PATCH', 'action'=>['UserFact@update', $fact->id]]) !!}

        <div class="form-group{{ $errors->has('facts') ? ' has-error' : '' }}">
            <label>मुख्य तथ्य</label>
            <input type="text" name="facts" value="{{$fact->fact}}" class="form-control" placeholder="मुख्य तथ्य" required="required">
            @if ($errors->has('facts'))
                <span class="help-block">
                    <strong>{{ $errors->first('facts') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
            <label>संख्या</label>
            <input type="text" name="number" value="{{$fact->num}}" class="form-control" placeholder="संख्या" required="required">
            @if ($errors->has('number'))
                <span class="help-block">
                    <strong>{{ $errors->first('number') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection