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
                                <li class="breadcrumb-item active">{{__('Subscriptions')}}</li>
                            </ul>
                        </div>
                        
                          <div class="col-auto float-right ml-auto">
                            
                            <a href="" class="btn add-btn" data-toggle="modal" data-target="#add_userplan"><i class="fa fa-plus"></i> {{ __('trans.Add Subscribe') }}</a>
                                
                            <div class="view-icons">
                                <a href="{{ route('subscribe-index',$subdomain) }}" class="grid-view btn btn-link" title="{{__('trans.grid')}}"><i class="fa fa-th"></i></a>
                                <a href="companies-list" class="list-view btn btn-link active" title="{{__('trans.list')}}"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
      
            
                </div>
                <!-- /Page Header -->
                
                    @if(isset($company_plan_current))
              
                     <div class="row mb-30 equal-height-cards">
                        <div class="col-md-4">
                            <div class="card pricing-box">
                                <div class="card-body d-flex flex-column">  
                                    <div class="mb-4">
                                        <h3>{{__('trans.Current plan')}}</h3>
                                        <span class="display-4">${{$company_plan_current->salary}}</span>
                                    </div>
                                    <ul>
                                        <li><i class="fa fa-check"></i> <b>{{$company_plan_current->number_user}} {{__('trans.User')}}</b></li>
                                        <li><i class="fa fa-check"></i> {{$company_plan_current->duration}}{{__('trans.duration')}} </li>
                                        
                                    </ul>
                                   
                                    <a href="" class="btn btn-lg  btn-success  mt-auto expand" data-toggle="modal" data-target="#add_userplan">{{__('trans.expand')}}</a>
                                </div>
                            </div>
                        </div>
                       
                      </div>
                      @endif

                         <!-- Plan Details -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-table mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Plan year</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>{{__('trans.Users')}}</th>
                                                    <th>{{__('trans.Plan Duration')}}</th>
                                                    <th>{{__('trans.Start Date')}}</th>
                                                    <th>{{__('trans.End Date')}}</th>
                                                    <th>{{__('trans.Amount')}}</th>
                                                   <!-- <th>{{__('trans.Update Plan')}}</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($company_plans as $company_plan)
                                                <tr>
                                                    
                                                    <td>{{$company_plan->number_user}} Users</td>
                                                    <td> {{$company_plan->duration}}{{$company_plan->pay_type}}</td>
                                                    <td>{{$company_plan->date_from}}</td>
                                                    <td>{{$company_plan->date_to}}</td>
                                                    <td>${{$company_plan->salary}}</td>
                                                   <!-- <td><a class="btn btn-primary btn-sm" href="javascript:void(0);">Change Plan</a></td>-->
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Plan Details -->       
          
                
            </div>
            <!-- /Page Content -->
              <!-- Add userplan Modal -->
            <div id="add_userplan" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">{{__('trans.Add User Plan')}}</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--<div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="{{route('subscribe-store-userplan',$subdomain)}}">
                                @csrf
                                <div class="row">
                                  <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('trans.currency') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="currency">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Number Users')}}</label>
                                                <input class="form-control" type="number" name="users">
                                            </div>
                                        </div>
                                       <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Type')}}</label>
    
                                                <select class="select" name="type">
                                                
                                                    <option value="month">{{__('trans.month')}}</option>
                                                    <option value="year">{{__('trans.year')}}</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.duration')}}</label>
                                                <input class="form-control" type="number" name="duration">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12"> 

                                            <div class="form-group form-focus ">
                                                    
                                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                                    <label class="focus-label">{{__('trans.Select Date From')}}</label>
                                            </div>
                
                                        </div>
    
                                 </div>
                                 <div class="col-sm-6">
        
                                        <div class="col-sm-12 show_count">
                                            <input class="form-control plan_id" type="hidden" name="plan_id">
                                                <div class="type">month</div>
                                                <label>{{__('trans.amount')}} <span class="text-danger">*</span></label>
                                                 <div class="amount-list">
                                                     <div class="price_per_user"></div>  <span class="currency"></span>
                                                     <div class="number_users"></div><span>users</span>
                                                      <div class="duration"></div><span>duraion</span>
                                                     <div class="total"></div> <span>per</span><span class="type">month</span>
                                                
                                                 </div>
                                        </div>
                                  </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button>
                                </div>
                            </form>-->
                            <form id="regForm" method="post" action="{{route('subscribe-store-userplan',$subdomain)}}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                  <input class="form-control" type="hidden" name="expand" />
                                <p>اختار باقتك :</p>
                                
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab col-sm-12">

                                  <div class="row ">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('trans.currency') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="currency">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Number Users')}}</label>
                                                <input class="form-control" type="number" name="users">
                                            </div>
                                        </div>

                                       <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Type')}}</label>
    
                                                <select class="select" name="type">
                                                
                                                    <option value="month">{{__('trans.month')}}</option>
                                                    <option value="year">{{__('trans.year')}}</option>
                                                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.duration')}}</label>
                                                <input class="form-control" type="number" name="duration">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6"> 
                                            <div class="form-group form-focus ">  
                                                   <label class="col-form-label">{{__('trans.Select Date From')}}</label>                                                  
                                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                                    
                                            </div>               
                                        </div>  
                                        <div class="m-60"></div>
                                        <div class="col-lg-12 show_count">
                                            <input class="form-control plan_id" type="hidden" name="plan_id">
                                                <div class="type">month</div>
                                                <label>{{__('trans.amount')}} <span class="text-danger">*</span></label>
                                                 <div class="amount-list">
                                                     <div class="price_per_user"></div>  <span class="currency"></span>
                                                     <div class="number_users"></div><span>users</span>
                                                      <div class="duration"></div><span>duraion</span>
                                                     <div class="total"></div> <span>per</span><span class="type">month</span>
                                                
                                                 </div>
                                        </div>  

                                </div>
                                </div>

                                <div class="tab">
                                
                                                <div class="row">
                                                <div class="form-group form-focus select-focus">
                                                        <select class="select floating paymethod" name="paymethod"> 
                                                           
                                                                <option value="visa">visa</option>
                                                                <option value="bank_convert">bank_convert</option>
                                                                <option value="postal_convert">postal_convert</option>
                                                                <option value="customer">customer</option>
                                                            
                                                        </select>
                                                        <label class="focus-label">{{__('trans.Payment Method')}}</label>
                                                    </div>  
                                                    <div class="bank_data col-sm-12" >
                                                      
                                                       
                                                           
                                                    
                                                                    <!--<h3 class="text-center">Payment Details</h3>-->
                                                                    <img class="img-responsive cc-img col-sm-12" src="https://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                                                                
                                                            
                                                            <div class="form-group">
                                                                <label>Card Number</label>
                                                                <div class="input-group">
                                                                    <input type="tel" class="form-control" placeholder="Valid Card Number" />
                                                                    <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                                </div>
                                                            </div>
                                                      
                                                       
                                                    
                                                  
                                                        
                                                            <div class="form-group">
                                                                <label><span class="hidden-xs">Expiration</span><span class="visible-xs-inline">Exp</span> Date</label>
                                                                <input type="tel" class="form-control" placeholder="MM / YY" />
                                                            </div>
                                                       
                                                       
                                                            <div class="form-group">
                                                                <label>Cv Code</label>
                                                                <input type="tel" class="form-control" placeholder="CVC" />
                                                            </div>
                                                     
                                                    
                                                    
                                                        
                                                            <div class="form-group">
                                                                <label>Card Owner</label>
                                                                <input type="text" class="form-control" placeholder="Card Owner Names" />
                                                            </div>
                                                      
                                                    </div>
                                                    <div class="convert"  style="display: none;">
                                                        <div class="form-group">
                                                            <label>file_attach</label>
                                                            <input type="file" class="form-control" placeholder="attach file" />
                                                        </div>
                                                    
                                                    </div>
                                                    <div class="customer"  style="display: none;">
                                                        <div class="form-group">
                                                           <label>customer</label>
                                                            <!--<input type="customer" class="form-control" placeholder="customer" />-->
                                                            <select class="form-group" name="rep_id">
                                                            @foreach($repesentatives as $repesentative)
                                                                <option value="{{$repesentative->id}}">{{$repesentative->name}}</option>
                                                            @endforeach
                                                            
                                                            
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                        
                                                            <label>amount</label>
                                                            <input type="number" class="form-control" placeholder="amount" />
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                </div>
                                

                                
                                <div style="overflow:auto;">
                                  <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">{{__('trans.Previous')}}</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">{{__('trans.Next')}}</button>
                                  </div>
                                </div>
                                
                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px;">
                                  <span class="step"></span>
                                  <span class="step"></span>

                                </div>

                            
                            </form>
                       </div>
                    </div>
                </div>
            </div>
          <!--  end Add userplan Modal-->
</div>
        <!-- /Page Wrapper -->

<style>


/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}


</style>
                                                      
              
@endsection
@section('script')


<script>
//$("#nextBtn").addClass("btn btn-primary submit-btn");
     getUrl=window.location;
             baseUrl1= getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
             baseUrl=baseUrl1+"/admin/";
    if($(".paymethod").val()=="visa"){
        
         getcheckOut_id();
    }
    $(".paymethod").on("change",function(){
    
       if($(".paymethod").val()=="visa"){
        //alert("ggg");
           getcheckOut_id();
         $(".convert").hide(); 
         $(".bank_data").toggle();
       }
       if($(".paymethod").val()=="bank_convert"||$(".paymethod").val()=="postal_convert"){
        $(".bank_data").hide();
        $(".convert").toggle();
       }
       if($(".paymethod").val()=="customer"){
        $(".bank_data").hide();
        $(".convert").hide();
        $(".customer").toggle();
       } 
        
        
    });
    function getcheckOut_id(){
        
               $.ajax({
                url:baseUrl+"payment_getCheckOutId",
                type:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    //alert("jkuhj");
                    
                    console.log(data.id);
                    $("#regForm").attr('action',baseUrl+'payment_checkout_status/'+data.id);
        
                }
           });
    }
    $("#add_userplan form select[name='type']").on( "change", function() {
           
       $(".show_count .type").text($("#add_userplan form select[name='type']").val());
         calcualte_toatal();

    });
    $("#add_userplan form input[name='users']").on( "change", function() {
        $(".show_count .number_users").text($("#add_userplan form input[name='users']").val());
        
         calcualte_toatal();
    });
    $("#add_userplan form input[name='duration']").on( "change", function() {
      
       $(".show_count .duration").text($("#add_userplan form input[name='duration']").val());
        calcualte_toatal();
    });
    function calcualte_toatal(){
             
       $.ajax({
        url:baseUrl+"subscribe_getPlan/"+$("#add_userplan form select[name='type']").val()+"/"+$("#add_userplan form input[name='currency']").val(),
        type:'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{type:$("#add_userplan form select[name='type']").val()},
        success: function(data) {
            $("price_per_user").text(data.price_user);
            $(".show_count .plan_id").val(data.id);
            $("currency").text(data.price_user);
            $(".show_count .total").text($("#add_userplan form input[name='users']").val()*$("#add_userplan form input[name='duration']").val()* data.price_user);
            
        }
       });
    }
</script>
  <script>
var currentTab = 0; // Current tab is set to be the first tab (0)

showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
    
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
   
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  alert( x.length);
  // Exit the function if any field in the current tab is invalid:
  if (n == 2 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
   
   // document.getElementById("regForm").submit();
    // $('#regForm').submit(function (e) {
   
       
        // e.preventDefault();
        currentTab=2;
       alert ($("#regForm").attr('action'));
              $.ajax({
                    url:$("#regForm").attr('action'),
                    type:'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(payment) {
                        console.log(payment);
                        //if(payment.status==""){
                            
    
                            var currency= $("#add_userplan form input[name='currency']").val();
                            var users= $("#add_userplan form input[name='users']").val();
                            var type= $("#add_userplan form select[name='type']").val();
                            var date_from= $("#add_userplan form input[name='date_from']").val();
                           
                            var duration= $("#add_userplan form input[name='duration']").val();
                            var total=  $(".show_count .amount-list .total").text();
                           
                             var paymethod= $("#add_userplan form select[name='paymethod']").val();
                            var rep_id= $("#add_userplan form select[name='rep_id']").val();
                             var plan_id=  $(".show_count .plan_id").val();
                           // alert(plan_id);

          
                                    //if(payment.result.description!="transaction pending"){
                                            $.ajax({
                                                url:baseUrl+"subscribe_store_userplan",
                                                type:'post',
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                data: {currency:currency,users:users,type:type,duration:duration,date_from:date_from,total:total,plan_id:plan_id,paymethod:paymethod,transaction_status:payment.result.description,transaction_id:payment.buildNumber,rep_id:rep_id},
                                                success: function(data) {
                                                    
                                                       if(data.hasOwnProperty('success')){
                				
                                                           //location.reload(true);
                                                        }else{
                                                            printErrorMsg(data.error);
                                                        }
                                                    }
                                            });
                                        
                                    //}else{
                                        //  printErrorMsg(data.error);
                                   // }
         

                   }
                          
                         // }
                       
            
                    
                });
                
    //});
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
@endsection