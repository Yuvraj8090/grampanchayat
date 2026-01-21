@extends('layouts.admin')

@section('content')
<style>
    .card{
        margin:10px;
        border:1px solid black;
        padding:10px 10px;
    }
    input{
        width:80% !important;
            display:inline !important;
    }
    }
    button{
        display:inline !important;
    }
 
</style>
<br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div style="margin:10px 50px;">
    <div class="card">
          <div class="card-header">
            <h4>Edit 
          </div>
          <div class="card-body">
                
                {!! Form::open(['method' => 'PATCH', 'action' => ['AdminPartinidhiController@update', $add->id]]) !!}
                
                <input type="textbox" class="form-control" name="content" value="{{ $add->content ?? '' }}" placeholder="Point title..." required />
                <input type="hidden" name="ref_id"  value="{{$add->ref_id}}" />
                @if ($errors->has('content'))
                    <span class="help-block">
                         <strong>{{ $errors->first('content') }}</strong>
                     </span>
                @endif
                
         
               <br>
               <br>
             
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
          </div>
    </div> 
</div>
@endsection
