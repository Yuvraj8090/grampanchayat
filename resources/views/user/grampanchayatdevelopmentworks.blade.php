<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Gram Panchayat Development Works | Gram Panchayat</title>

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_cover_1">
                        ग्राम पंचायत में हुए विकास कार्यो की झलक
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <th class="text-center">क्रमांक</th>
                            <th class="text-center">कार्य का नाम </th>
                            <th class="text-center">कार्य के बारेमे</th>
                            <th class="text-center">योजना का नाम </th>
                            <th class="text-center">वर्ष दिनक </th>
                            <th class="text-center">राशि  </th>
                            <th class="text-center">स्तीथि </th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($work as $works)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$works->name}}</td>
                                <td>{{$works->about}}</td>
                                <td>{{$works->y_name}}</td>
                                <td>{{$works->year}}</td>
                                <td>{{$works->price}}</td>
                                <td>{{$works->place}}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
                    
                </div>
                
            </div>
        </div>
        

@endsection
