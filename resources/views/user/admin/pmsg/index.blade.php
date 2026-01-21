@extends('layouts.admin')

@section('content')
    <br />

    @if(Session::has('insert'))
        <div class="alert alert-success">
            <strong> {{session('insert')}}</strong>
        </div>

        <br />
    @endif

    <a href="{{route('user-p-message.create')}}" class="btn btn-primary btn-xs band">
        <i class="fa fa-plus fa-fw"></i> Add
    </a>

    <br />
    <br />
 
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <th class="text-center">प्रधान सन्देश</th>
                <th class="text-center" style="width:100px;">Operation</th>
            </thead>

            <tbody>
                @foreach($msg as $msgs)
                    <tr>
                        <td>
                            <?php $check = $msgs->msg;
                            $new = preg_replace("/<script\s(.+?)>(.+?)<\/script>/is", "<b>$2</b>", $check);
                            $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<b>$2</b>", $new);

                            // echo (substr($string, 0, 400)); ?>

                            {!! $string !!}
                        </td>

                        <td>
                            <a class="btn btn-success btn-xs" href="{{route('user-p-message.edit', $msgs->id)}}">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>

                    <style type="text/css">.band{display:none;}#tourist-box{width:auto!important}</style>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection