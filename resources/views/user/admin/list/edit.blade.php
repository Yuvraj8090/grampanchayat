@extends('layouts.admin')

@section('content')
<br/>
@if(Session::has('insert'))
    <div class="alert alert-danger">
        <strong> {{session('insert')}}</strong>
    </div><br/>
@endif
<a href="{{route('user-list.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
    {!! Form::model($list, ['method'=>'PATCH', 'action'=>['UserList@update', $list->id], 'files'=>true]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>नाम:</label>
            <input type="text" name="name" value="{{$list->name}}" class="form-control" required="required" placeholder="नाम">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
            <label>पद:</label>
            <select class="form-control" name="position" required="required">
                @if($list->position == "प्रधान")
                <option>{{$list->position}}</option>
                <option>प्रधान</option>
                <option>उपप्रधान</option>
                <option>बी0 डी0 सी0</option>
                <option>समाज सेवी</option>
                <option>जिला पंचायत</option>
                <option>क्षेत्र पंचायत</option>
                <option>ग्राम पंचायत अधिकारी</option>
                <option>लेखपाल</option>
                <option>सदस्य</option>>
                @else
                <option>{{$list->position}}</option>
                <option>उपप्रधान</option>
                <option>सदस्य</option>
                @endif
            </select>
            @if ($errors->has('position'))
                <span class="help-block">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('block') ? ' has-error' : '' }}">
            <label>वार्ड:</label>
            <select class="form-control" name="block" required="required">
                <option>{{$list->block}}</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
            </select>
            @if ($errors->has('block'))
                <span class="help-block">
                    <strong>{{ $errors->first('block') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label>फ़ोन नंबर :</label>
            <input type="number" name="phone" class="form-control" value="{{$list->phone}}" placeholder="फ़ोन नंबर ">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <img src="/images/{{$list->image}}" class="img-responsive" style="width:200px;height:200px;">
        </div>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>फोटो:</label>
            <input type="file" name="image">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
        </div>

    {!! Form::close() !!}
    </div> 
@endsection