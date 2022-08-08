<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <meta name="description" content="Smarthr - Bootstrap Admin Template" />
        <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects" />
        <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
        <meta name="robots" content="noindex, nofollow" />
        <title>{{__('trans.Register')}}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}" />
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}" />
      	<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
		<!-- Datetimepicker CSS -->
        <!--<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>-->
         <!--<script src="{{asset('js/bootstrap.min.js')}}"></script>-->
	    <!--<script src="{{asset('js/select2.min.js')}}"></script>-->

		<!--<script src="{{asset('js/jquery-ui.min.js')}}"></script>-->
		<link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="account-page">
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <div class="account-content">
                <div class="container">
                    <!-- Account Logo -->
                    <div class="account-logo">
                        <a href=""><img src="https://dawam.net/manger/public/img/logo.png" alt="{{__('trans.DWAM')}}" /></a>
                    </div>
                    <!-- /Account Logo -->

                    <div class="account-boxx">
                        <div class="">
                            <h3 class="account-title">{{__('trans.Register')}}</h3>

                            <!-- Account Form -->
                            <div class="alert alert-danger print-error-msg" style="display: none;">
                                <ul></ul>
                            </div>

                            <form id="register" method="post">
                                <div class="alert alert-danger print-error-msg" style="display: none;">
                                    <ul></ul>
                                </div>

                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.Name')}}</label>
                                                <input class="form-control" name="name" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.Email')}}</label>
                                                <input class="form-control" name="email" type="text" />
                                                <span id="message_email"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.Password')}}</label>
                                                <input id="password" name="password" class="form-control" type="password" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.Repeat Password')}}</label>
                                                <input id="confirm_password" name="confirm_password" class="form-control" type="password" />
                                                <span id="message"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.phone')}}</label>
                                                <input name="phone" class="form-control" type="text" />
                                                <span id="message_phone"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.company')}}</label>
                                                <input name="company" class="form-control" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.country')}}</label>
                                                <select class="form-control form-control-lg" name="country">
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->country_code}}">{{$country->country_name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      <!--  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>{{__('trans.category')}}</label>
                                                <select class="form-control form-control-lg" name="category">
                                                    @foreach($categories as $category)
                                                    <option value="{{$category['id']}}">{{$category['title']}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>-->
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <span class="pay-now">{{__('trans.pay_now')}}</span>
                                                <label class="switch">
                                                    <input type="checkbox" class="check-pay" value="0" />
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab">
                                    <div class="account-boxx">
                                        <div class="">
                                            

                                            <!-- Account Form -->
                                            <div class="alert alert-danger print-error-msg" style="display: none;">
                                                <ul></ul>
                                            </div>
                                            
                                            <div class="row">

                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-form-label">{{ __('trans.currency') }} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="hidden" name="currency" value="egp" />
                                            </div>
                                            </div>

                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Number Users')}}</label>
                                                <input class="form-control number_users" min="1" type="number" name="users" />
                                            </div>
                                            </div>

                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Type')}}</label>
                                                <select class="select type" name="type">
                                                    <option value="month">{{__('trans.month')}}</option>
                                                    <option value="year">{{__('trans.year')}}</option>
                                                </select>
                                            </div>
                                            </div>

                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label">{{__('trans.duration')}}</label>
                                                <input class="form-control" type="number" min="1" name="duration" />
                                            </div>
                                            </div>

                                            <div class="col-lg-6">
                                            <div class="form-group form-focus">
                                                <label class="col-form-label">{{__('trans.Select Date From')}}</label>
                                                <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from" /></div>
                                            </div>
                                            </div>

                                            </div>

                                            <section id="our-stats">
                                                <div class="row text-center show_count">
                                                    <input class="form-control plan_id" type="hidden" name="plan_id" />
                                                    <div class="col-lg-4">
                                                        <div class="counter">
                                                            <i class="fa fa-user fa-2x"></i>
                                                            <h2 class="timer count-title count-number number_users"></h2>
                                                            <p class="count-text">Users</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="counter">
                                                            <i class="fa fa-calendar-o fa-2x"></i>
                                                            <h2 class="timer count-title count-number duration"></h2>
                                                            <p class="count-text">Duration</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="counter">
                                                            <i class="fa fa-money fa-2x"></i>
                                                            <h2 class="timer count-title count-number total"></h2>
                                                            <p class="count-text">Amount</p>
                                                        </div>
                                                    </div>
                                                    <div class="amount-list">
                                                        <div class="price_per_user"></div>
                                                        <span class="currency"></span>
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- /Account Form -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab">
                                    <div class="row">
                                     <div class="col-lg-12">
                                        <div class="form-group form-focus select-focus">
                                            <select class="select floating paymethod dropdown-reg" name="paymethod">
                                                 <option>{{__('trans.select pay method')}}</option>
                                                <option value="visa">{{__('trans.paypall')}}</option>
                                                <option value="bank_convert">{{__('trans.bank_convert')}}</option>
                                                <option value="postal_convert">{{__('trans.postal_convert')}}</option>
                                                <!--<option value="customer">customer</option>-->
                                            </select>
                                            <!--<label class="focus-label">{{__('trans.Payment Method')}}</label>-->
                                        </div>
                                        </div>

                                        <div class="bank_data col-lg-12">
                                            <div id="smart-button-container">
                                                <div style="text-align: center;">
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="convert" style="display: none;">
                                            <input class="form-control" type="hidden" id="attach" name="attach" />
                                            <div class="form-group">
                                                <label>file_attach</label>
                                                <input type="file" id="file" class="form-control input_convert" placeholder="attach file" name="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="overflow: auto;">
                                    <div style="text-align: center;">
                                        <button class="next-dawam" type="button" id="prevBtn" onclick="nextPrev(1)">{{__('trans.Previous')}}</button>
                                        <button class="prev-dawam" type="button" id="nextBtn" onclick="nextPrev(-1)">{{__('trans.Next')}}</button>
                                    </div>
                                </div>

                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align: center; margin-top: 40px;">
                                    <span class="step"></span>
                                    <span class="step"></span>
                                    <span class="step"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->

        <!-- jQuery -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

        <script>
         $(function () {
           $(".datetimepicker").datetimepicker({
        		format: 'YYYY-MM-DD',
        	});
          });

            /* second tab script  */
            //$("#nextBtn").addClass("btn btn-primary submit-btn");
            getUrl = window.location;
            baseUrl1 = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];
            baseUrl = baseUrl1 + "/admin/";
            /*if($(".paymethod").val()=="visa"){
        
         getcheckOut_id();
    }*/

            $(document).ready(function () {
                /*
             set select payment ooption

        */

                $("#root input").addClass("input_visa");
                $("#root select").addClass("input_visa");
                $(".bank_data").show();
                $(".paymethod").on("change", function () {
                  
                    if ($(".paymethod").val()=="visa"&&$(".paymethod").val()== ""||$(".paymethod").val()=="visa") {
                        //alert("ggg");
                        // getcheckOut_id();
                        $(".convert").hide();
                        $(".bank_data").show();
                    }
                    if ($(".paymethod").val() == "bank_convert" || $(".paymethod").val() == "postal_convert") {
                        $(".convert").show();
                        $(".bank_data").hide();
                    }
                });

                /*
       start upload attach
  */

                $("#register input[name='file']").change(function () {
                    var fd = new FormData();

                    var files = $("#file")[0].files;
                    console.log(files);
                    // Check file selected or not
                    if (files.length > 0) {
                        fd.append("file", files[0]);

                        $.ajax({
                            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                            url: '{{route("images.signupStoreImage",$subdomain)}}',
                            type: "post",
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response);
                                if (response != 0) {
                                    $("#attach").val(response);
                                } else {
                                    alert("file not uploaded");
                                }
                            },
                        });
                    } else {
                        alert("Please select a file.");
                    }
                });

                /* end upload attach*/
            });

            $("#register select[name='type']").on("change", function () {
                $(".type").val();//.text($("#register select[name='type']")
                calcualte_toatal();
            });
            $("#register input[name='users']").on("change", function () {
                $(".number_users").text($("#register input[name='users']").val());
                calcualte_toatal();
            });
            $("#register input[name='duration']").on("change", function () {
                $(".duration").text($("#register input[name='duration']").val());
                calcualte_toatal();
            });
            function calcualte_toatal() {
                $.ajax({
                    url: baseUrl1+ "/sign_up_subscribe_getPlan/" + $("#register select[name='type']").val() + "/" + $("#register input[name='currency']").val(),
                    type:"post",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: {type: $("#register select[name='type']").val() },
                    success: function (data) {
                        $(".price_per_user").text(data.price_user);
                        $(".show_count .plan_id").val(data.id);
                        $(".currency").text(data.price_user);
                        $(".show_count .total").text($("#register input[name='users']").val() * $("#register input[name='duration']").val() * data.price_user);
                    },
                });
            }
        </script>
        <script>
            var payment;
            var currentTab = 0; // Current tab is set to be the first tab (0)
            var total = 0;
            showTab(currentTab); // Display the current tab
            function showTab(n) {
                //alert(n);
                // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("tab");

                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:

                var toggle = false;
                $(".switch .slider").click(function () {
                    $(".check-pay").attr("checked", !toggle);
                    toggle = !toggle;
                    if (toggle == true) $(".check-pay").val(1);
                    else $(".check-pay").val(0);
                    //alert("toggle"+$('.check-pay').val());
                    if ($(".check-pay").val() == 1) {
                       
                        //  alert(n);
                        if (n == 0) {
                            document.getElementById("prevBtn").style.display = "none";
                            document.getElementById("nextBtn").innerHTML ="{{__('trans.Next')}}";
                        } else if (n > 0 && n < 3) {
                            //alert("tab_b");
                            document.getElementById("prevBtn").style.display = "inline";
                            document.getElementById("nextBtn").innerHTML = "{{__('trans.Next')}}";
                        }
                    } else {
                        document.getElementById("nextBtn").innerHTML ="{{__('trans.Submit')}}";
                    }
                });

                if ($(".check-pay").val() == 0) {
                $("#nextBtn").click(function () {
                  valid_input= validateForm();
            
                        if (document.getElementById("nextBtn").innerHTML == "{{__('trans.Submit')}}"&&valid_input!=false && $(".check-pay").val()==0) {
                            
                            
                            submitRegData([]);

                            //window.location.href = "{{route('test2_moaz',$subdomain)}}";
                        }else{
                            // nextPrev(currentTab);
                          
                        }
                    });
                }
                if ($(".check-pay").val() == 1) {
                   // alert("it's checked");
                    if (n == 0) {
                       // alert("tt");
                        document.getElementById("nextBtn").innerHTML ="{{__('trans.Next')}}";
                        document.getElementById("prevBtn").style.display = "none";
                    } 

                    if (n == 1 || n == 2) {
                       // alert("ll");
                        document.getElementById("prevBtn").style.display = "inline";
                        if(n==1)
                        document.getElementById("nextBtn").innerHTML ="{{__('trans.Next')}}";
                    }
                    if (n == x.length - 1) {
                       // alert("oo");
                        document.getElementById("prevBtn").style.display = "inline";
                        document.getElementById("nextBtn").innerHTML ="{{__('trans.Submit')}}";
                    }
                }else{
                   
                    document.getElementById("prevBtn").style.display = "none";

                    //currentTab=2;
                    // nextPrev(currentTab);

                    document.getElementById("nextBtn").innerHTML ="{{__('trans.Submit')}}";
                }



                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n);
            }

            function nextPrev(n) {
                // alert(currentTab);
                // alert("hjh");
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");

                //alert("xlengh"+x.length);
                // Exit the function if any field in the current tab is invalid:

                 if (!validateForm()&&(n!=-1)) {
       
                    return false;
                 }
                 if (document.getElementById("nextBtn").innerHTML =="{{__('trans.Submit')}}"&&n!=-1) {
                       // showTab(currentTab);
                       if (currentTab==(x.length-1)) {
                        // ... the form gets submitted:
    
                        // document.getElementById("regForm").submit();
    
                        // alert("2reg");
                        submitRegData(payment);
        
                       // window.location.href = "{{route('test2_moaz',$subdomain)}}";
    
                        
                       }
                    return false;
                 }
                // Hide the current tab:

                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:

                currentTab = currentTab + n;
               // alert("current tab"+currentTab);
                // if you have reached the end of the form...



                // Otherwise, display the correct tab:
               showTab(currentTab);
            }

            function submitRegData(payment) {
                var name = $("#register input[name='name']").val();
                var email = $("#register input[name='email']").val();
                var password = $("#register input[name='password']").val();
                var confirm_password = $("#register input[name='confirm_password']").val();
                var phone = $("#register input[name='phone']").val();
                var company = $("#register input[name='company']").val();
                var pay_status = $(".check-pay").val();
                var country = $("#register select[name='country']").val();
                var category = $("#register select[name='category']").val();
                var time_zone = $("#register select[name='time_zone']").val();
                data = { name: name, email: email, password: password, confirm_password: confirm_password, phone: phone, company: company, pay_status: pay_status, country: country, time_zone: time_zone,category:category};
                if ($(".check-pay").val() == 1) {
                    var currency = $(" form input[name='currency']").val();
                    var users = $(" form input[name='users']").val();
                    var type = $(" form select[name='type']").val();
                    var date_from = $(" form input[name='date_from']").val();

                    var duration = $(" form input[name='duration']").val();
                    total= $(".show_count .total").text();

                    var paymethod = $(" form select[name='paymethod']").val();
                    var rep_id = $(" form select[name='rep_id']").val();
                    var plan_id = $(".show_count .plan_id").val();
                    if ($("form select[name='paymethod']").val() == "visa" && !payment == null) {
                        transaction_status = payment.status;
                        transaction_id = payment.id;
                        file_path = "";
                        if (transaction_id == null) pay_status = 0;
                        else pay_status = 1;
                    } else if ($("form select[name='paymethod']").val() == "bank_convert" || $("form select[name='paymethod']").val() == "postal_convert") {
                        transaction_status= null;
                        transaction_id =null;
                        file_path = $("#attach").val();
                        pay_status = 1;
                    } else {
                        transaction_status= null;
                        transaction_id =null;
                        var file_path = "";
                        pay_status = 0;
                    }

                    data = {
                        name: name,
                        email: email,
                        password: password,
                        confirm_password: confirm_password,
                        phone: phone,
                        company: company,
                        pay_status: pay_status,
                        country: country,
                        category:category,
                        time_zone: time_zone,
                        currency: currency,
                        users: users,
                        type: type,
                        duration: duration,
                        date_from: date_from,
                        total: total,
                        plan_id: plan_id,
                        paymethod: paymethod,
                        transaction_status:transaction_status,
                        transaction_id: transaction_id,
                        rep_id: rep_id,
                        file_path: file_path,
                    };
                }

                $.ajax({
                    url: "{{route('userRegister',$subdomain)}}",
                    type: "POST",
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    data: data,
                    success: function(data) {
                        if (data.hasOwnProperty("success")) {
                               if((document.getElementById("paypal-button-container").innerHTML == "Thank you for your payment!")||($("#attach").val()!=""||data.success=="trans.Added successfully.")){
                                 window.location.href = "{{route('show_success',$subdomain)}}";
                               }
                        } else {
                            // printErrorMsg(data.error);
                              alert(data.error);
                        }
                    },
                });
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x,
                    y,
                    i,
                  valid = true;  
                x = document.getElementsByClassName("tab");
                //alert($(" form select[name='paymethod']").val());
                //alert("current_"+currentTab);
                 tab_=currentTab;
                if ($("form select[name='paymethod']").val() == "visa" && currentTab == 2) {
                    y = x[tab_].getElementsByClassName("input_visa");
                } else if ($("form select[name='paymethod']").val() == "bank_convert" && currentTab == 2) {
                    y = x[tab_].getElementsByClassName("input_convert");
                } else {
                    y = x[tab_].getElementsByTagName("input");
                }
               console.log(y);
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                   
                    // If a field is empty...
                    if (y[i].value == "") {
                    
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }else{
                    
                       y[i].className =y[i].className.replace(" invalid", "")
                    }
                }
               // if ($("#message_email").val() != null) $("#register input[name='email']").addClass(" invalid");
              //  if ($("#message_phone").val() != null) $("#register input[name='phone']").addClass(" invalid");
               // if ($("#message_email").html() != "" || $("#message_phone").html() != "") valid = false;
               // else valid = true;

                // If the valid status is true, mark the step as finished and valid:
               /* if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }*/

                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i,
                    x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class on the current step:
                x[n].className += " active";
            }
        </script>
        <script type="text/javascript">
            /* check validation inputs*/
            $("#password, #confirm_password").on("keyup", function () {
                if ($("#password").val() == $("#confirm_password").val()) {
                    $("#message").html("Matching").css("color", "green");
                } else $("#message").html("Not Matching").css("color", "red");
            });

            // function  email_validate(){
            /* check email exist inputs*/
            $("#register input[name='email']").on("keyup", function () {
                email = $("#register input[name='email']").val();

                $.ajax({
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    url: '{{route("users.check_email",$subdomain)}}',
                    type: "post",
                    data: { email: email },

                    success: function (response) {
                        if (!response.hasOwnProperty("success")) {
                            $("#message_email").html(response.error).css("color", "red");
                            //  printErrorMsg(data.error);
                        } else {
                            $("#message_email").empty();
                            $("#register input[name='email']").removeClass(" invalid");
                        }
                    },
                });
            });
            $("#register input[name='phone']").on("keyup", function () {
                phone = $("#register input[name='phone']").val();

                $.ajax({
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    url: '{{route("users.check_email",$subdomain)}}',
                    type: "post",
                    data: { phone: phone },

                    success: function (response) {
                        if (!response.hasOwnProperty("success")) {
                            $("#message_phone").html(response.error).css("color", "red");
                            //  printErrorMsg(data.error);
                        } else {
                            $("#message_phone").empty();
                            $("#register input[name='phone']").removeClass(" invalid");
                        }
                    },
                });
            });

            // }

            /*  $("#register .register_button").click(function(e){
         

        });*/
        </script>

        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                paypal
                    .Buttons({
                        style: {
                            shape: "rect",
                            color: "gold",
                            layout: "vertical",
                            label: "paypal",
                        },

                        createOrder: function (data, actions) {
                            total = $(".show_count .total").text();
                            return actions.order.create({
                                purchase_units: [{ description: "Pay secure with Paypal for Dawam subscruibs", amount: { currency_code: "USD", value: total } }],
                            });
                        },

                        onApprove: function (data, actions) {
                            return actions.order.capture().then(function (orderData) {
                                payment = orderData.purchase_units[0].payments.captures[0];

                                // $("#register input[name='status']").val(transaction.status);
                                // $("#register input[name='transaction_id']").val(transaction.id );
                                // Full available details
                                console.log("Capture result",orderData, JSON.stringify(orderData, null, 2));

                                // Show a success message within this page, e.g.
                                const element = document.getElementById("paypal-button-container");
                                element.innerHTML = "";
                                element.innerHTML = "<h3>Thank you for your payment!</h3>";
                      
                                // Or go to another URL:  actions.redirect('thank_you.html');
                            });
                        },

                        onError: function (err) {
                            console.log(err);
                        },
                    })
                    .render("#paypal-button-container");
            }
            initPayPalButton();
        </script>

        <!-- Bootstrap Core JS -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('js/fullcalendar.min.js')}}"></script>
        <script src="{{asset('js/jquery.fullcalendar.js')}}"></script>
        <script src="{{asset('js/moment.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
        <!-- Custom JS -->
        <script src="{{asset('js/app.js')}}"></script>
        <style>
            /* Rounded sliders */
            .slider.round {
                border-radius: 34px !important;
            }

            .slider.round:before {
                border-radius: 50% !important;
            }
            .pay-now {
                margin-left: 15px !important;
            }
            .btn-dark {
                width: 49% !important;
                padding: 14px !important;
            }
            .profit-filter {
                display: inline-flex !important;
                width: 100% !important;
            }
        </style>

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
                background-color: #ffdddd !important;
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
                background-color: #04aa6d;
            }
            div#go-to-xoon-error-message {
                background-color: #ede9f1;
            }
        </style>
    </body>
</html>
