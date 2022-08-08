@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                
                <!-- Page Header -->
                <div class="page-header">
                    
                    <div class="row">
                        <div class="col-sm-8 col-4">
                            <h3 class="page-title">Subscriptions</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('payment-Subscriptions')}}</li>
                            </ul>
                        </div>
                    </div>
      
            
                </div>
                <!-- /Page Header -->
            
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                    

                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 col-md-offset-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <h3 class="text-center">Payment Details</h3>
                                                <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <form role="form">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD NUMBER</label>
                                                            <div class="input-group">
                                                                <input type="tel" class="form-control" placeholder="Valid Card Number" />
                                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                                            <input type="tel" class="form-control" placeholder="MM / YY" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5 pull-right">
                                                        <div class="form-group">
                                                            <label>CV CODE</label>
                                                            <input type="tel" class="form-control" placeholder="CVC" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD OWNER</label>
                                                            <input type="text" class="form-control" placeholder="Card Owner Names" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-warning btn-lg btn-block">Process payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .cc-img {
                                margin: 0 auto;
                            }
                        </style>
                        <!-- Credit Card Payment Form - END -->

                        </div>
                    </div>
                
                </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->



@endsection