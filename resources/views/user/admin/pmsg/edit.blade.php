@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-envelope"></i> Update Pradhan Message (प्रधान सन्देश)</h3>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Message Details
        <div class="pull-right">
            <a href="{{ route('user-p-message.index') }}" class="btn btn-primary btn-xs" style="margin-top: -5px;">
                <i class="fa fa-arrow-left fa-fw"></i> Back
            </a>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                
                {{-- IMPORTANT: enctype is required for file uploads --}}
                <form action="{{ route('user-p-message.update', $msg->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Message Field (TinyMCE) --}}
                    <div class="form-group @error('msg') has-error @enderror">
                        <label for="msg">Message (सन्देश)</label>
                        {{-- Changed to Textarea for rich text content --}}
                        <textarea name="msg" id="msg" class="form-control tinymce-editor" rows="10">{{ old('msg', $msg->msg) }}</textarea>
                        
                        @error('msg')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <hr>

                    {{-- Current Image Preview --}}
                    <div class="row">
                        <div class="col-md-3">
                            <label>Current Image:</label>
                            <div class="thumbnail">
                                @if($msg->image)
                                    <img src="{{ asset('images/' . $msg->image) }}" alt="Current Image" style="width:100%; height:auto;">
                                @else
                                    <div class="text-center" style="padding: 20px;">No Image</div>
                                @endif
                            </div>
                        </div>

                        {{-- Image Upload Input --}}
                        <div class="col-md-9">
                            <div class="form-group @error('image') has-error @enderror">
                                <label for="image">Update Image (Optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <p class="help-block">Allowed formats: jpeg, png, jpg, gif.</p>
                                
                                @error('image')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>
                    
                    {{-- Submit Button --}}
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa fa-save"></i> Update Message
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    {{-- Load TinyMCE from CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '.tinymce-editor', // Target the specific class
                height: 400,
                menubar: false,
                promotion: false, // Hides the "Upgrade" button
                branding: false,  // Hides the "Powered by TinyMCE" branding
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save(); // Ensures content is synced to the textarea before submit
                    });
                }
            });
        });
    </script>
@endsection