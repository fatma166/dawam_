<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>{{__('trans.Register')}} </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
		
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
						<a href=""><img src="https://dawam.net/manger/public/img/logo.png" alt="{{__('trans.DWAM')}}"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">{{__('trans.Register')}}</h3>
	
							<!-- Account Form -->
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
						<!--	<form  id="register"  method="post">
							    @csrf
							    <div class="form-group">
									<label>{{__('trans.Name')}}</label>
									<input class="form-control" name="name" type="text">
								</div>
								<div class="form-group">
									<label>{{__('trans.Email')}}</label>
									<input class="form-control" name="email" type="text">
								</div>
								<div class="form-group">
									<label>{{__('trans.Password')}}</label>
									<input id="password" name="password" class="form-control" type="password">
									
								</div>
								<div class="form-group">
									<label>{{__('trans.Repeat Password')}}</label>
									<input id="confirm_password" name="confirm_password" class="form-control" type="password">
								     <span id="message"></span>
								</div>
								<div class="form-group">
									<label>{{__('trans.phone')}}</label>
									<input name="phone" class="form-control" type="text">
								</div>
								<div class="form-group">
									<label>{{__('trans.company')}}</label>
									<input name="company" class="form-control" type="text">
								</div>
                                <div class="form-group">
									<label>الدولة</label>
									<select class="form-control form-control-lg">
                                        <option>Egypt</option>
                                        <option>Saudi Arabia</option>
                                        <option>Jordan</option>
                                    </select>
								</div>
                                <div class="form-group">
									<label>التوقيت الزمنى</label>
									<select class="form-control form-control-lg">
                                        <option value="(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
                                        <option value="(GMT -6:00) Central Time (US & Canada), Mexico City">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
                                        <option value="(GMT -7:00) Mountain Time (US & Canada)">(GMT -7:00) Mountain Time (US & Canada)</option>
                                        <option value="(GMT -8:00) Pacific Time (US & Canada)">(GMT -8:00) Pacific Time (US & Canada)</option>
                                        <option value="(GMT -9:00) Alaska">(GMT -9:00) Alaska</option>
                                        
                                        <option value="(GMT -12:00) Eniwetok, Kwajalein">(GMT -12:00) Eniwetok, Kwajalein</option>
                                        <option value="(GMT -11:00) Midway Island, Samoa">(GMT -11:00) Midway Island, Samoa</option>
                                        <option value="(GMT -10:00) Hawaii">(GMT -10:00) Hawaii</option>
                                        <option value="(GMT -9:30) Taiohae">(GMT -9:30) Taiohae</option>
                                        <option value="(GMT -9:00) Alaska">(GMT -9:00) Alaska</option>
                                        <option value="(GMT -8:00) Pacific Time (US & Canada)">(GMT -8:00) Pacific Time (US & Canada)</option>
                                        <option value="(GMT -7:00) Mountain Time (US & Canada)">(GMT -7:00) Mountain Time (US & Canada)</option>
                                        <option value="(GMT -6:00) Central Time (US & Canada), Mexico City">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
                                        <option value="(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
                                        <option value="(GMT -4:30) Caracas">(GMT -4:30) Caracas</option>
                                        <option value="(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                        <option value="(GMT -3:30) Newfoundland">(GMT -3:30) Newfoundland</option>
                                        <option value="(GMT -3:00) Brazil, Buenos Aires, Georgetown">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                        <option value="(GMT -2:00) Mid-Atlantic">(GMT -2:00) Mid-Atlantic</option>
                                        <option value="(GMT -1:00) Azores, Cape Verde Islands">(GMT -1:00) Azores, Cape Verde Islands</option>
                                        <option value="(GMT +0:00) Western Europe Time, London, Lisbon, Casablanca">(GMT +0:00) Western Europe Time, London, Lisbon, Casablanca</option>
                                        <option value="(GMT +1:00) Brussels, Copenhagen, Madrid, Paris">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                                        <option value="(GMT +2:00) Kaliningrad, South Africa">(GMT +2:00) Kaliningrad, South Africa</option>
                                        <option value="(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                        <option value="(GMT +3:30) Tehran">(GMT +3:30) Tehran</option>
                                        <option value="(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                        <option value="(GMT +4:30) Kabul">(GMT +4:30) Kabul</option>
                                        <option value="(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                        <option value="(GMT +5:30) Bombay, Calcutta, Madras, New Delhi">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                        <option value="(GMT +5:45) Kathmandu, Pokhara">(GMT +5:45) Kathmandu, Pokhara</option>
                                        <option value="(GMT +6:00) Almaty, Dhaka, Colombo">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                        <option value="(GMT +6:30) Yangon, Mandalay">(GMT +6:30) Yangon, Mandalay</option>
                                        <option value="(GMT +7:00) Bangkok, Hanoi, Jakarta">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                        <option value="(GMT +8:00) Beijing, Perth, Singapore, Hong Kong">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                        <option value="(GMT +8:45) Eucla">(GMT +8:45) Eucla</option>
                                        <option value="(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                        <option value="(GMT +9:30) Adelaide, Darwin">(GMT +9:30) Adelaide, Darwin</option>
                                        <option value="(GMT +10:00) Eastern Australia, Guam, Vladivostok">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                        <option value="(GMT +10:30) Lord Howe Island">(GMT +10:30) Lord Howe Island</option>
                                        <option value="(GMT +11:00) Magadan, Solomon Islands, New Caledonia">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                        <option value="(GMT +11:30) Norfolk Island">(GMT +11:30) Norfolk Island</option>
                                        <option value="(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                        <option value="(GMT +12:45) Chatham Islands">(GMT +12:45) Chatham Islands</option>
                                        <option value="(GMT +13:00) Apia, Nukualofa">(GMT +13:00) Apia, Nukualofa</option>
                                        <option value="(GMT +14:00) Line Islands, Tokelau">(GMT +14:00) Line Islands, Tokelau</option>
                                    </select>
								</div>
                                <div class="form-group">
                                    <span class="pay-now">ادفع الأن</span>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
								</div>
								<div class="form-group text-center">
									<a class="btn btn-primary account-btn" href="https://mohamedabdelrahman.org/Attendence-v1/admin/test1_moaz" >{{__('trans.Register')}}</a>
								</div>
								<div class="account-footer">
									<p>{{__('trans.Already have an account')}} ? <a href="{{route('login')}}" >{{__('trans.Login')}}</a></p>
								</div>
							</form>-->
							<!-- /Account Form -->
                             <form id="register"  method="post" >
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                    
                                
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab col-sm-12">
                                           <div class="row">
                                            <div class="form-group">
            									<label>{{__('trans.Name')}}</label>
            									<input class="form-control" name="name" type="text">
            								</div>
            								<div class="form-group">
            									<label>{{__('trans.Email')}}</label>
            									<input class="form-control" name="email" type="text">
            								</div>
            								<div class="form-group">
            									<label>{{__('trans.Password')}}</label>
            									<input id="password" name="password" class="form-control" type="password">
            									
            								</div>
            								<div class="form-group">
            									<label>{{__('trans.Repeat Password')}}</label>
            									<input id="confirm_password" name="confirm_password" class="form-control" type="password">
            								     <span id="message"></span>
            								</div>
            								<div class="form-group">
            									<label>{{__('trans.phone')}}</label>
            									<input name="phone" class="form-control" type="text">
            								</div>
            								<div class="form-group">
            									<label>{{__('trans.company')}}</label>
            									<input name="company" class="form-control" type="text">
            								</div>
                                            <div class="form-group">
            									<label>الدولة</label>
            									<select class="form-control form-control-lg" name="country">
                                                @foreach($countries as $country)
                                                    <option value="{{$country->country_code}}">{{$country->country_name}}</option>
                                                    
                                                    
                                                    
                                                @endforeach
                                                    <!--<option>Saudi Arabia</option>
                                                    <option>Jordan</option>-->
                                                </select>
            								</div>
                                           <!-- <div class="form-group">
            									<label>التوقيت الزمنى</label>
            									<select class="form-control form-control-lg"  name="time_zone">
                                                    <option value="(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
                                                    <option value="(GMT -6:00) Central Time (US & Canada), Mexico City">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
                                                    <option value="(GMT -7:00) Mountain Time (US & Canada)">(GMT -7:00) Mountain Time (US & Canada)</option>
                                                    <option value="(GMT -8:00) Pacific Time (US & Canada)">(GMT -8:00) Pacific Time (US & Canada)</option>
                                                    <option value="(GMT -9:00) Alaska">(GMT -9:00) Alaska</option>
                                                    
                                                    <option value="(GMT -12:00) Eniwetok, Kwajalein">(GMT -12:00) Eniwetok, Kwajalein</option>
                                                    <option value="(GMT -11:00) Midway Island, Samoa">(GMT -11:00) Midway Island, Samoa</option>
                                                    <option value="(GMT -10:00) Hawaii">(GMT -10:00) Hawaii</option>
                                                    <option value="(GMT -9:30) Taiohae">(GMT -9:30) Taiohae</option>
                                                    <option value="(GMT -9:00) Alaska">(GMT -9:00) Alaska</option>
                                                    <option value="(GMT -8:00) Pacific Time (US & Canada)">(GMT -8:00) Pacific Time (US & Canada)</option>
                                                    <option value="(GMT -7:00) Mountain Time (US & Canada)">(GMT -7:00) Mountain Time (US & Canada)</option>
                                                    <option value="(GMT -6:00) Central Time (US & Canada), Mexico City">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
                                                    <option value="(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
                                                    <option value="(GMT -4:30) Caracas">(GMT -4:30) Caracas</option>
                                                    <option value="(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                                    <option value="(GMT -3:30) Newfoundland">(GMT -3:30) Newfoundland</option>
                                                    <option value="(GMT -3:00) Brazil, Buenos Aires, Georgetown">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                                    <option value="(GMT -2:00) Mid-Atlantic">(GMT -2:00) Mid-Atlantic</option>
                                                    <option value="(GMT -1:00) Azores, Cape Verde Islands">(GMT -1:00) Azores, Cape Verde Islands</option>
                                                    <option value="(GMT +0:00) Western Europe Time, London, Lisbon, Casablanca">(GMT +0:00) Western Europe Time, London, Lisbon, Casablanca</option>
                                                    <option value="(GMT +1:00) Brussels, Copenhagen, Madrid, Paris">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                    <option value="(GMT +2:00) Kaliningrad, South Africa">(GMT +2:00) Kaliningrad, South Africa</option>
                                                    <option value="(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                                    <option value="(GMT +3:30) Tehran">(GMT +3:30) Tehran</option>
                                                    <option value="(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                                    <option value="(GMT +4:30) Kabul">(GMT +4:30) Kabul</option>
                                                    <option value="(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                                    <option value="(GMT +5:30) Bombay, Calcutta, Madras, New Delhi">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                                    <option value="(GMT +5:45) Kathmandu, Pokhara">(GMT +5:45) Kathmandu, Pokhara</option>
                                                    <option value="(GMT +6:00) Almaty, Dhaka, Colombo">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                                    <option value="(GMT +6:30) Yangon, Mandalay">(GMT +6:30) Yangon, Mandalay</option>
                                                    <option value="(GMT +7:00) Bangkok, Hanoi, Jakarta">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                                    <option value="(GMT +8:00) Beijing, Perth, Singapore, Hong Kong">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                                    <option value="(GMT +8:45) Eucla">(GMT +8:45) Eucla</option>
                                                    <option value="(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                                    <option value="(GMT +9:30) Adelaide, Darwin">(GMT +9:30) Adelaide, Darwin</option>
                                                    <option value="(GMT +10:00) Eastern Australia, Guam, Vladivostok">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                                    <option value="(GMT +10:30) Lord Howe Island">(GMT +10:30) Lord Howe Island</option>
                                                    <option value="(GMT +11:00) Magadan, Solomon Islands, New Caledonia">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                                    <option value="(GMT +11:30) Norfolk Island">(GMT +11:30) Norfolk Island</option>
                                                    <option value="(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                                    <option value="(GMT +12:45) Chatham Islands">(GMT +12:45) Chatham Islands</option>
                                                    <option value="(GMT +13:00) Apia, Nukualofa">(GMT +13:00) Apia, Nukualofa</option>
                                                    <option value="(GMT +14:00) Line Islands, Tokelau">(GMT +14:00) Line Islands, Tokelau</option>
                                                </select>
            								</div>-->
                                            <div class="form-group">
                                                <span class="pay-now">ادفع الأن</span>
                                            <label class="switch">
                                                <input type="checkbox" class="check-pay" value="0"/>
                                                <span class="slider round"></span>
                                            </label>
            								</div>
            								<!--<div class="form-group text-center">
            									<a class="btn btn-primary account-btn" href="https://mohamedabdelrahman.org/Attendence-v1/admin/test1_moaz" >{{__('trans.Register')}}</a>
            								</div>
            								<div class="account-footer">
            									<p>{{__('trans.Already have an account')}} ? <a href="{{route('login')}}" >{{__('trans.Login')}}</a></p>
            								</div>-->
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
                                                                <input type="tel" class="form-control input_visa" placeholder="Valid Card Number" />
                                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                            </div>
                                                        </div>
                                                  
                                                   
                                                
                                              
                                                    
                                                        <div class="form-group">
                                                            <label><span class="hidden-xs">Expiration</span><span class="visible-xs-inline">Exp</span> Date</label>
                                                            <input type="tel" class="form-control input_visa" placeholder="MM / YY" />
                                                        </div>
                                                   
                                                   
                                                        <div class="form-group">
                                                            <label>Cv Code</label>
                                                            <input type="tel" class="form-control input_visa" placeholder="CVC" />
                                                        </div>
                                                 
                                                
                                                
                                                    
                                                        <div class="form-group">
                                                            <label>Card Owner</label>
                                                            <input type="text" class="form-control input_visa" placeholder="Card Owner Names" />
                                                        </div>
                                                  
                                                </div>
                                                <div class="convert"  style="display: none;">
                                                    <div class="form-group">
                                                        <label>file_attach</label>
                                                        <input type="file" class="form-control input_convert " placeholder="attach file" />
                                                    </div>

                                                </div>
                                                <div class="customer"  style="display: none;">
                                                    <div class="form-group">
                                                       <label>customer</label>
                                                        <input type="customer" class="form-control" placeholder="customer" />
                                                    </div>
                                                    <div class="form-group">
                                                    
                                                        <label>amount</label>
                                                        <input type="number" class="form-control input_convert" placeholder="amount" />
                                                    
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
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
		<script type="text/javascript">
        
        $('#password, #confirm_password').on('keyup', function () {
        
        if ($('#password').val() == $('#confirm_password').val()) {
        
        	$('#message').html('Matching').css('color', 'green');
        
        } else 
        
        	$('#message').html('Not Matching').css('color', 'red');
        
        });    
      /*  $("#register .register_button").click(function(e){
         

        });*/
</script>

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
  background-color: #04AA6D;
}


</style>



<script>

/* second tab script  */
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
                url:baseUrl+"payment_register_getCheckOutId",
                type:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    //alert("jkuhj");
                    
                    console.log(data.id);
                    $("#register").attr('action',baseUrl+'payment_register_checkout_status/'+data.id);
        
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
      
      
      
       var toggle = false;
        $('.switch .slider').click(function() {
    
            $(".check-pay").attr("checked",!toggle);
            toggle = !toggle;
            if(toggle==true)$(".check-pay").val(1);
          
             if($('.check-pay').is(':checked')) { 
              
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else if(n>0&& n<2) {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
                
              } else {
     
    
                 if($('.check-pay').is(':checked')) { 
                 
                 
                    document.getElementById("nextBtn").innerHTML = "Next";
                 
                 
                  }else{
                   
                    document.getElementById("nextBtn").innerHTML = "Submit"; 
                  }
             
              }
             
           //  document.getElementById("nextBtn").innerHTML = "Next";
             
             
             
              }else{
               
               document.getElementById("nextBtn").innerHTML = "Submit"; 
              }
        });
        if($('.check-pay').is(':checked')) { alert("it's checked");
         
         
                document.getElementById("nextBtn").innerHTML = "Next";
         
         
          }else{
                 
                document.getElementById("prevBtn").style.display = "none";
                 if (n == 1) {
                        document.getElementById("prevBtn").style.display = "inline";
                 }
                //currentTab=2;
               // nextPrev(2);
                document.getElementById("nextBtn").innerHTML = "Submit"; 
          }
          $("#nextBtn").click(function(){
              if (n == 1&&  document.getElementById("nextBtn").innerHTML == "Submit") {
                alert("yaaa");
                    submitRegData();
                }
            
          });
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }
    
    function nextPrev(n) {
       alert(currentTab+"=>"+n);
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
    //   alert( x.length);
      // Exit the function if any field in the current tab is invalid:
      alert(n);
      if (n > 2 || !validateForm()){alert("false"); return false;}
      // Hide the current tab:
    
      x[currentTab].style.display = "none";    
      // Increase or decrease the current tab by 1:

      currentTab = currentTab + n;
      alert("current tab"+currentTab);
      // if you have reached the end of the form...
   
      if (currentTab >= x.length){
        // ... the form gets submitted:
       
       // document.getElementById("regForm").submit();
        // $('#regForm').submit(function (e) {
       
           
            // e.preventDefault();
           // currentTab=2;
            alert($("#register").attr('action'));
             $.ajax({
                    url:$("#register").attr('action'),
                    type:'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(payment) {
                            console.log(payment);
                            submitRegData;
                            }
                   });
            
            
          // alert ($("#register").attr('action'));
           

                    /* $.ajax({
                        url:$("#register").attr('action'),
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
                           
                
                        
                    });*/
                    
        //});
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }
    
    function submitRegData(){

                    var name= $("#register input[name='name']").val();
                    var email= $("#register input[name='email']").val();
                    var password= $("#register input[name='password']").val();
                    var confirm_password= $("#register input[name='confirm_password']").val();
                    var phone= $("#register input[name='phone']").val();
                    var company= $("#register input[name='company']").val();
                    var pay_status= $(".check-pay").val();
                    var country=  $("#register select[name='country']").val();
                    var time_zone= $("#register select[name='time_zone']").val();
                    data={name:name, email:email ,password:password,confirm_password:confirm_password,phone:phone,company:company,pay_status:pay_status,country:country,time_zone:time_zone};
                    if($(".check-pay").val()==1){
                            var currency= $(" form input[name='currency']").val();
                            var users= $(" form input[name='users']").val();
                            var type= $(" form select[name='type']").val();
                            var date_from= $(" form input[name='date_from']").val();
                           
                            var duration= $(" form input[name='duration']").val();
                            var total=  $(".show_count .amount-list .total").text();
                           
                            var paymethod= $(" form select[name='paymethod']").val();
                            var rep_id= $(" form select[name='rep_id']").val();
                            var plan_id=  $(".show_count .plan_id").val();
                            data={name:name,email:email,password:password,confirm_password:confirm_password,phone:phone,company:company,pay_status:pay_status,country:country,time_zone:time_zone,currency:currency,users:users,type:type,duration:duration,date_from:date_from,total:total,plan_id:plan_id,paymethod:paymethod,transaction_status:payment.result.description,transaction_id:payment.buildNumber,rep_id:rep_id}
                    }
                    
                    $.ajax({
                        url:"{{route('userRegister')}}",
                        type:'POST',
        			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:data,
                        success: function(data) {
                            
                            if(data.hasOwnProperty('success')){
        				
                               window.location.href = "{{route('login')}}";
                            }else{
                                printErrorMsg(data.error);
                              alert(data.error);
                             
                            }
                        }
                });
    }
    
    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      alert($(" form select[name='paymethod']").val());
     if( ($(" form select[name='paymethod']").val()=="visa")&& (currentTab==1)){
         y = x[currentTab].getElementsByClass("input_visa");
        
     }else if(( $("form select[name='paymethod']").val()=="bank_convert")&&( currentTab==1)){
         y = x[currentTab].getElementsByClass("input_convert");
     }else{
      y = x[currentTab].getElementsByTagName("input");
      }
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        alert(i);
        // If a field is empty...
        if (y[i].value == "") {
           // alert("hi");
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
    <script>
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
		<!-- Bootstrap Core JS -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('js/app.js')}}"></script>

    </body>
</html>