<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Gram Panchayat</title>
    <style type="text/css">
        .mySlides {display:none;}
    </style>

@section('content')


        <div class="w3-content w3-display-container">

            @foreach($photo as $photos)

            <div class="w3-display-container mySlides">
                <img src="/images/{{$photos->image}}" class="img-responsive">
               <!--  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black hidden-xs">
                    Gram Panchayat
                </div> -->
            </div>
            @endforeach

            <div class="w3-display-container mySlides newno">
                <img src="/images/no.png" class="img-responsive">
               <!--  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black hidden-xs">
                    Gram Panchayat
                </div> -->
            </div>
            


            <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

        </div>
        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                    <div class="heading_cover">
                        ग्राम पंचायत में आपका स्वागत है 
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


                        
                   
                    </p>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <th class="text-center">क्रमांक</th>
                            <th class="text-center">मुख्य तथ्य</th>
                            <th class="text-center">संख्या</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($fact as $facts)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$facts->fact}}</td>
                                <td>{{$facts->num}}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        

@endsection
