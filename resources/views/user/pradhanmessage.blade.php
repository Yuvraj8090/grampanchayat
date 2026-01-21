<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Pradhan Message | Gram Panchayat</title>

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                    @if($msg)
                    <center><img src="/images/{{$msg->image ? $msg->image : 'user.jpg'}}" class="img-responsive" style="width:150px;height:150px;float:left;margin-right:20px;"></center>
                    @endif
                    <p class="para">

                        @if($msg)

                         <?php

            $check = $msg->msg;

            $new = preg_replace("/<script\s(.+?)>(.+?)<\/script>/is", "<b>$2</b>", $check);

            $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<b>$2</b>", $new);

            echo ($string);

             
             ?>
             @else

             <center>No Record Found</center>

             @endif
</p>

                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        

@endsection
