<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Contact Us | Gram Panchayat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css">
    <style type="text/css">
        iframe{width:100%!important;height:350px!important;}
    </style>
@section('content')
@if($add)
        <?php 
        $map = $add->map;

        if (strpos($map, 'https://www.google.com/maps/embed?') == false) 
        {
            echo " <div class='alert alert-danger'>
                <strong> It seems your link is not working! </strong>
          </div>";
        }
        else
        {
            echo $map;   
        }
      ?>
      @endif
        <div class="padding">
            <div class="row">
                <div class="col-md-8">                   
                    <div class="heading_cover">
                         ग्राम पंचायत
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <th class="text-center">पता </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@if($add){{$add->address}}@endif</td>
                            </tr>                           
                        </tbody>
                    </table>
                </div>
                <div class="heading_cover">                     
                       ग्राम पंचायत से जनपद स्तर के मुख्य विभाग और उनकी दुरी
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <th class="text-center">क्रमांक </th>
                            <th class="text-center">विभाग का नाम </th>
                            <th class="text-center">पता  </th>
                            <th class="text-center">दुरी (लगभग) </th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($lo as $los)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$los->name}} </td>
                                <td>{{$los->place}}</td>
                                <td>{{$los->distance}}</td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox-plus-jquery.min.js"></script>

@endsection
