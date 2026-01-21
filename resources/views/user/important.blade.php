<!DOCTYPE html>
<html>
<head> 
@extends('layouts.user')

    <title>Important Information | Gram Panchayat</title>

@section('content')

        <div class="padding">
            <div class="row">
                <div class="col-md-8">
                    <div class="heading_cover_1">
                        सरकार द्वारा चलायी जा रही ऑनलाइन योजनाओं का फायदा उठाये और समय के साथ साथ पैसे भी बचाये |
                    </div>
                    <b>अपनी पेंशन देखने के लिए नीचे दिए गये लिंक पर क्लिक करे </b><br/>
                    <a href="http://ssp.uk.gov.in/reports/PenDetailedInfo.aspx" style="color:blue;">
                        <b>अपनी पेंशन देखे</b>
                    </a>
                    <br/><br/>
                    <b>अपना आधार नंबर की जानकारी देखने के लिए नीचे दिए गये लिंक पर क्लिक करे </b><br/>
                    <a href="https://eaadhaar.uidai.gov.in/" style="color:blue;"><b>अपना आधार नंबर देखे </b></a>
                    <br/><br/>
                    <b>अपना बिजली का बिल ऑनलाइन जमा करने के लिए नीचे दिए गये लिंक पर क्लिक करे </b><br/>
                    <a href="https://www.upcl.org/wss/Login.htm" style="color:blue;"><b>अपना बिजली का बिल जमा करें </b></a>
                    <br/><br/>
                    <b>अपना फ़ोन का बिल ऑनलाइन जमा करने के लिए नीचे दिए गये लिंक पर क्लिक करे </b><br/>
                    <a href="portal.bsnl.in/portal/aspxfiles/login.aspx" style="color:blue;"><b>अपना लैंडलाइन फ़ोन का बिल जमा करे </b></a>
                    <br/>
                    
        <div class="heading_cover">
                ग्राम पंचायत में बनने वाले मुख्य प्रमाण पत्र 
        </div>
        @if(count($data) > 0)
            @foreach($data as $d)
                <b>{{$d->title}}</b> 
                <ol>
                    @foreach($d->posts as $post)
                        <li>{{ $post->content }}</li>
                    @endforeach
                </ol> 
                    @if($d->link_title)
                        <a href="{{ $d->title }}" style="color:blue;">{{ $d->link_title }}</a>
                    @endif
                <br>
              
            @endforeach
        @endif
   

                </div>
                <div class="col-md-4">
                    @include('user.right')
                </div>
            </div>
        </div>
        

@endsection
