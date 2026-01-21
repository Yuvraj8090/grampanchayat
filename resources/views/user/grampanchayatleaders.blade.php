<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Gram Panchayat Leaders | Gram Panchayat</title>

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                    <div class="heading_cover_1">
                        ग्राम पंचायत के प्रमुख जन प्रतिनिधि
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <th class="text-center">क्रमांक</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">नाम </th>
                            <th class="text-center">पद </th>
                            <th class="text-center">वार्ड </th>
                            <th class="text-center">फ़ोन नंबर </th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($list as $lists)
                            <tr>
                                <td>{{$i}}</td>
                                <td><center><img src="/images/{{$lists->image ? $lists->image : 'user.jpg'}}" class="img-responsive" alt="{{$lists->name}}" style="width:100px;height:100px;"></center></td>
                                <td>{{$lists->name}}</td>
                                <td>{{$lists->position}}</td>
                                <td>{{$lists->block}}</td>
                                <td>{{$lists->phone}}</td>
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
