<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Gallery | Gram Panchayat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css">

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8">                   
                    <div class="row">
                        @foreach($photo as $photos)
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <a href="/images/{{$photos->image ? $photos->image : 'user.jpg'}}" target='_blank' data-lightbox='gram'><img src="/images/{{$photos->image ? $photos->image : 'user.jpg'}}" alt="{{$photos->alt}}" class="img-responsive"></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox-plus-jquery.min.js"></script>

@endsection
