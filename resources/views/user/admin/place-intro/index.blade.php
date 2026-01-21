@extends('layouts.admin')

@section('content')
    <br />

    @if(Session::has('insert'))
        <div class="alert alert-success">
            <strong> {{session('insert')}}</strong>
        </div>

        <br />
    @endif

    <a class="btn btn-primary btn-xs band" href="{{route('user-places-intro.create')}}">
        <i class="fa fa-plus fa-fw"></i> Add
    </a>

    <br />
    <br />
 
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <th class="text-center">परिचय</th>
                <th class="text-center" style="width:100px;">Operation</th>
            </thead>

            <tbody>
                @foreach($add as $address)
                    <tr>
                        <td>
                            <?php $check = $address->intro;
                            $new    = preg_replace("/<script\s(.+?)>(.+?)<\/script>/is", "<b>$2</b>", $check);
                            $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<b>$2</b>", $new);

                            //echo (substr($string, 0, 400)); ?>

                            {!! $string !!}
                        </td>

                        <td>
                            <a href="{{route('user-places-intro.edit', $address->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                @endforeach

                <style type="text/css">.band{display:none;}#tourist-box{width:auto!important}</style>
            </tbody>
        </table>
    </div>
@endsection