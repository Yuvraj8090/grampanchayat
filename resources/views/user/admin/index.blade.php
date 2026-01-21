@extends('layouts.admin')

@section('content')
<div class="row">
                   <div class="col-lg-12">
                        <h3> {{$user->name}} - Dashboard </h3>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                           
                            <a class="quick-btn" href="{{route('user-register.index')}}">
                                <i class="fa fa-registered icon-2x"></i>
                                <span> Registrations</span>
                                <span class="label label-danger">{{$count}}</span>
                            </a>

                            <!-- <a class="quick-btn" href="#">
                                <i class="fa fa-envelope icon-2x"></i>
                                <span>Messages</span>
                                <span class="label label-success">456</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="fa fa-signal icon-2x"></i>
                                <span>Profit</span>
                                <span class="label label-warning">+25</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="fa fa-external-link icon-2x"></i>
                                <span>value</span>
                                <span class="label btn-metis-2">3.14159265</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="fa fa-tasks icon-2x"></i>
                                <span>tasks</span>
                                <span class="label btn-metis-4">107</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="fa fa-bolt icon-2x"></i>
                                <span>Tickets</span>
                                <span class="label label-default">20</span>
                            </a> -->

                            
                            
                        </div>

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                  

                
@endsection