@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <a href="{{route('admin-user.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br><br>
    <a href="{{ url('excel/Panchayat_Upload_Excel_File.xlsx') }}" class="pull-right btn btn-primary btn-sm" download>
        <i class="fa fa-file fa-fw"></i> Download Sample Excle file
    </a>
    <br />
    @if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div><br />
    @endif

    <form action="{{ url('/panchayat/excel')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        <!--<div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">-->
        <!--    <div class="form-group">-->
        <!--        <label class="col-md-12 control-label">State</label>-->
        <!--        <div class="col-md-12">-->
        <!--            <select data-url="{{ url('/disticts') }}" data-variable="district" class="form-control element " name="state" required="required">-->
        <!--                @if(count($states) > 0)-->
        <!--                <option value="">Select State</option>-->
        <!--                @foreach($states as $state)-->
        <!--                <option value="{{$state->id}}">{{$state->name}}</option>-->

        <!--                @endforeach-->
        <!--                @endif-->
        <!--            </select>-->
        <!--            @if ($errors->has('stream'))-->
        <!--            <span class="help-block">-->
        <!--                <strong>{{ $errors->first('stream') }}</strong>-->
        <!--            </span>-->
        <!--            @endif-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">-->
        <!--    <div class="form-group">-->
        <!--        <label class="col-md-12 control-label">District</label>-->
        <!--        <div class="col-md-12">-->
        <!--            <select id="district" data-url="{{ url('/blocks') }}" data-variable="block" class="form-control element" name="district" required="required">-->

        <!--                <option value="">Select District</option>-->


        <!--            </select>-->
        <!--            @if ($errors->has('district'))-->
        <!--            <span class="help-block">-->
        <!--                <strong>{{ $errors->first('district') }}</strong>-->
        <!--            </span>-->
        <!--            @endif-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">-->
        <!--    <div class="form-group">-->
        <!--        <label class="col-md-12 control-label">Block</label>-->
        <!--        <div class="col-md-12">-->
        <!--            <select id="block" class="form-control" name="block" required="required">-->

        <!--                <option value="">Select Block</option>-->


        <!--            </select>-->
        <!--            @if ($errors->has('block'))-->
        <!--            <span class="help-block">-->
        <!--                <strong>{{ $errors->first('block') }}</strong>-->
        <!--            </span>-->
        <!--            @endif-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="row{{ $errors->has('stream') ? ' has-error' : '' }}">
            <div class="form-group">
                <label for="phone" class="col-md-12 control-label">Excel File:</label>
                <div class="col-md-12">
                    <input id="phone" type="file" class="form-control" name="file" required placeholder="Excel File">
                    @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

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