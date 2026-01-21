<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Tourist Places | Gram Panchayat</title>

@section('content')


       
        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                    <div class="heading_cover_1">
                        ग्राम पंचायत के मुख्य स्थल और पर्यटक स्थल
                    </div>
                    <p class="para">

                        @if($intro)
                         <?php

            $check = $intro->intro;

            $new = preg_replace("/<script\s(.+?)>(.+?)<\/script>/is", "<b>$2</b>", $check);

            $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<b>$2</b>", $new);

            echo ($string);

             
             ?>
             @else

             <center>No Record Found</center>


             @endif
                    </p><br/>
                    @foreach($place as $places)
                    <div class="row">
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <center><img src="/images/{{$places->image ? $places->image : 'user.jpg'}}" class="img-responsive" style="width: 200px;height:150px;"></center>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="heading_cover">
                                {{$places->name}}
                            </div>
                            <p class="para">
                               {{$places->about}}
                            </p>
                        </div>
                    </div>
                   @endforeach
               
                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        

@endsection
