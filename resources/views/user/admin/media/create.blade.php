@extends('layouts.admin')
<script src="{{ asset('js/corp.js') }}"></script>
<script src="{{ asset('js/cp.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icropper.css') }}">
   <meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<br/>
<a href="{{route('user-media.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <br/><br/>
    <div class="container">
   

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>Choose Image</label>
            <input type="file" name="image" required="required" id="upload">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div id="upload-demo" style="width:350px;margin-left:2px;"></div>
        </div>
        <div class="form-group">
            <center><a class="btn btn-success btn-sm upload-result">Submit</a></center>
        </div>

  
    </div> 
<script type="text/javascript">
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1100,
        height: 400,
        type: 'square'
    },
    boundary: {
        width: 1110,
        height: 410
    }
});
$('#upload').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    document.getElementById('apbut').style.display = 'block';
});
$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            url: "{{route('user-media.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "image":resp
            },
            success: function (data) {
              window.location.href = "/user-media";
            }
        });
    });
});
</script>  
@endsection