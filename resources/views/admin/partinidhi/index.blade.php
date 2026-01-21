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
            <h4>Add Title  <button class="pull-right"  id="addButton">Add Input</button></h4>   
          </div>
          <div class="card-body">
                
                @if(false)
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminPartinidhiController@update', $add->id]]) !!}
                @endif
                    
                {!! Form::open(['method'=>'POST', 'action'=>'AdminPartinidhiController@store']) !!}

                <input type="hidden" name="ref_id" value="{{ $id ?? '' }}" />
                <input type="textbox" class="form-control" name="content[]" placeholder="Point title..." required />
                @if ($errors->has('content'))
                    <span class="help-block">
                         <strong>{{ $errors->first('content') }}</strong>
                     </span>
                @endif
                
                <div id="inputContainer" >
                    
                </div>
               <br>
             
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
          </div>
    </div> <br/>
 
    <div class="table-responsive">
                    <table style="width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center" style="width:40px;">S.No</th>
                            <th class="text-center" style="width:120px;">Point</th>
                            <th class="text-center" style="width:100px;">Created Date</th>
                            <th class="text-center" style="width:120px;">Operation</th>
                        </thead>
                        
                        <tbody>
                            @if(count($data) > 0)
                                @foreach($data as $key => $d)
                                    <tr>
                                        <td>{{ $data->firstItem() + $key }} {{ $d->id }}</td>
                                        <td>{{ $d->content }} </td>
                                        <td>{{ date("d,M Y h:i A",strtotime($d->created_at)) }} </td>
                                         <td>
                                            <a class="btn btn-info btn-sm" href="{{ url('points/edit/'.$d->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')" href="{{ url('points/delete/'.$d->id) }}">Delete</a> 
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
</div>
@endsection

@section('script')
   <script>
    // jQuery document ready function
    $(document).ready(function() {
      // Add input field and delete button
      $("#addButton").on("click", function() {
        var newInput = $('<input>', { type: 'text', name: 'content[]', placeholder: 'Enter value', required: true, class: 'form-control' });
        var deleteButton = $('<button>', { class: 'deleteButton', text: 'Delete' });

        var inputContainer = $('<div>').append(newInput, deleteButton);

        $("#inputContainer").append(inputContainer);
      });

      // Remove input field and delete button
      $("#inputContainer").on("click", ".deleteButton", function() {
        $(this).parent().remove();
      });
    });
    
 </script>
@endsection