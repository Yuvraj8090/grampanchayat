<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Video | Gram Panchayat</title>

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8"> 
                    @foreach($video as $videos)                  
                    <h3>{{$videos->title}}</h3>
                    <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{$videos->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p class="para">
                        {{$videos->about}}
                    </p>
                    <br/>
                    @endforeach
                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
@endsection
