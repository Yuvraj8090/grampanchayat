@extends('layouts.app')

@section('page_title'){{ __('Contact Us | ') }}@endsection

@section('inpage_styles')
<style>
    .breads > ul {
        padding: 0;
        list-style: none;
    }
    .breads > ul > li {
    	color: #2c2c2c;
    	display: inline-block;
    	font-size: 14px;
    	padding-right: 10px;
    }
    .breads > ul > li > a {
	    color: #2c2c2c;
    }
    .breads > ul > li > i {
	    color: #777;
	    font-size: 12px;
    }
</style>
@endsection

@section('content')
    <main>
        <section class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="breads">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><i class="glyphicon glyphicon-chevron-right"></i></li>
                            <li>Contact Us</li>
                        </ul>

                        <h1>Contact Us</h1>
                    </div>

                    <div class="inner-content">
                        <div class="row">
                            <form action="" method="POST" class="form-horizontal" autocomplete="off">
                                <div class="form-body row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="fname">First Name<sup class="text-danger">*</sup></label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" maxlength="250" id="fname" name="fname" value="" />
                                            </div>
                                            <div class="col-md-12">
                                                <span class="text-danger field-validation-valid"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="lname">Last Name</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" maxlength="250" id="lname" name="lname" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="email">Email<sup class="text-danger">*</sup></label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" maxlength="250" id="email" name="email" value="" />
                                            </div>
                                            <div class="col-md-12">
                                                <span class="text-danger field-validation-valid"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12" for="phone">Mobile No.</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" maxlength="10" id="phone" name="phone" value="" />
                                            </div>
                                            <div class="col-md-12">
                                                <span class="text-danger field-validation-valid"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12" for="msg">Message/Query</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" id="msg" name="msg" rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-block btn-primary" type="submit" id="btnSubmit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection