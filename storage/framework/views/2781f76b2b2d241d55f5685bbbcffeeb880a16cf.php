<!-- jQuery -->

<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo e(asset('js/jquery.slimscroll.min.js')); ?>"></script>

		<!-- Select2 JS -->
		<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>

		<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/jquery.ui.touch-punch.min.js')); ?>"></script>
		
		<!-- Datetimepicker JS -->  
		<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/bootstrap-datetimepicker.min.js')); ?>"></script>
		
		<!-- Calendar JS -->
		<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.fullcalendar.js')); ?>"></script>

		<!-- Multiselect JS -->
		<script src="<?php echo e(asset('js/multiselect.min.js')); ?>"></script>

		<!-- Datatable JS -->
		<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/dataTables.bootstrap4.min.js')); ?>"></script>

		<!-- Summernote JS -->
		<script src="<?php echo e(asset('plugins/summernote/dist/summernote-bs4.min.js')); ?>"></script>
		
			
		<script src="<?php echo e(asset('plugins/sticky-kit-master/dist/sticky-kit.min.js')); ?>"></script>

		<!-- Task JS -->
		<script src="<?php echo e(asset('js/task.js')); ?>"></script>

		<!-- Dropfiles JS
		<script src="<?php echo e(asset('js/dropfiles.js')); ?>"></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="<?php echo e(asset('js/app.js')); ?>"></script>
		<script>
        	var myLatlng;
		 $(document).ready(function(){
		  
           
 		     getUrl=window.location;
             baseUrl1= getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
             baseUrl=baseUrl1+"/";
             img_url=getUrl .protocol + "//" + getUrl.host + "/manger/";
			$(".btn-outline-secondary").click(function(e){
		
			e.preventDefault();
			id= $(this).attr('id');

			 let _token= $('meta[name="csrf-token"]').attr('content');
				$.ajax(
				{
					type: "POST",
					url: "<?php echo e(route('upgrade-subscribe',$subdomain)); ?>",
					data: {id:id,_token: _token}, 
					success: function(data)
					{
					let url='subscribe_pay/'+id+'/'+data;
					
						 window.location.href='<?php echo e(url('/')); ?>'+'/admin/'+url;
					
					}
				}); 

			});
        

        /*  search select 2 to employee */
        $('.employee_name').select2({
           // placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectEmployeeSearch',
                dataType: 'json',
                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
 
         /*  search select 2 to employee */
        $('.employee_name_branch').select2({
            //placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectEmployeeSearchBranch',
                dataType: 'json',
               
                data: function (params) {
                      return {
                        q: params.term, // search term
                       branch:$("#add_outdoor select[name='branch']").val()
                      };
                    },
                                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
         /*  search select 2 to employee */
        $('.client_name_branch').select2({
            //placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectClientSearchBranch',
                dataType: 'json',
               
                data: function (params) {
                      return {
                        q: params.term, // search term
                        branch:$("select[name='branch']").val()   //#add_outdoor
                      };
                    },
                                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
         /*  search select 2 to client_name */
        $('#client_search_form .client_name').select2({
            //placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectClientSearch',
                dataType: 'json',
               
                data: function (params) {
                      return {
                        q: params.term, // search term
                        client:$("select[name='client']").val()   //#add_client
                      };
                    },
                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
        
        /***
        
          ZONE SEARCH
        **/
                 
         $('.zone_id').select2({
           // placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectZoneSearch',
                dataType: 'json',
                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.zone_name,
                                id: item.zone_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $("select[name='branch']").on('change', function() {
         
           branch=this.value;
                     /*  search select 2 to employee */
        $('.client_name_branch').select2({
            //placeholder: 'Select employee_name',
            ajax: {
                url: baseUrl+'selectClientSearchBranch',
                dataType: 'json',
               
                data: function (params) {
                      return {
                        q: params.term, // search term
                        branch:  branch   //#add_outdoor
                      };
                    },
                                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
      });
      /* end select2 */
        // Read value on page load
        $("#result b").html($("#customRange").val());

        // Read value on change
        $("#customRange").change(function(){
            $("#result b").html($(this).val());
        });
    });        
		$(".header").stick_in_parent({
			
		});
		// This is for the sticky sidebar    
		$(".stickyside").stick_in_parent({
			offset_top: 60
		});
		$('.stickyside a').click(function() {
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 500);
			return false;
		});
		// This is auto select left sidebar
		// Cache selectors
		// Cache selectors
		var lastId,
			topMenu = $(".stickyside"),
			topMenuHeight = topMenu.outerHeight(),
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind click handler to menu items


		// Bind to scroll
		$(window).scroll(function() {
			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight - 250;

			// Get id of current scroll item
			var cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop)
					return this;
			});
			// Get the id of the current element
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				// Set/remove active class
				menuItems
					.removeClass("active")
					.filter("[href='#" + id + "']").addClass("active");
			}
		});
		$(function () {
			$(document).on("click", '.btn-add-row', function () {
				var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
				console.log(id);
				var div = $("<tr />");
				div.html(GetDynamicTextBox(id));
				$("#"+id+"_tbody").append(div);
			});
			$(document).on("click", "#comments_remove", function () {
				$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
				$(this).closest("tr").remove();
			});
			function GetDynamicTextBox(table_id) {
				$('#comments_remove').remove();
				var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		</script>
		<script>
/*usershifts*/
/*add_schedule*/
$("#add_schedule button").click(function(e){

    e.preventDefault();
var url=$('#add_schedule form').attr('action');

 var date_from= $("#add_schedule form input[name='date_from']").val();
    var date_to= $("#add_schedule form input[name='date_to']").val();
    var time_in= $("#add_schedule form input[name='time_in']").val();
    var time_in_min= $("#add_schedule form input[name='time_in_min']").val();
    var time_in_max= $("#add_schedule form input[name='time_in_max']").val();
    var time_out= $("#add_schedule form input[name='time_out']").val();
    var time_out_min= $("#add_schedule form input[name='time_out_min']").val();
    var time_out_max= $("#add_schedule form input[name='time_out_max']").val();
    var break_time= $("#add_schedule form input[name='break_time']").val();
    var active= $("#add_schedule form input[name='active']").val();
    var over_time= $("#add_schedule form input[name='over_time']").val();
    var shift_id= $("#add_schedule form select[name='shift_id']").val();
    var user_id= $("#add_schedule form select[name='user_id']").val();

 var  data= {
        date_from:date_from,
        date_to:date_to,
        time_in:time_in,
        time_in_min:time_in_min,
        time_in_max:time_in_max,
        time_out:time_out,
        time_out_min:time_out_min,
        time_out_max:time_out_max,
        break_time:break_time,
        active:active,
        over_time:over_time,
        shift_id:shift_id,
        user_id:user_id
    };




// if($(this).attr('type')=="edit"){
//    url=$('#edit_role form').attr('action');
//    var name= $("#edit_role form input[name='name']").val();
//   // var permission= $("#edit_role form input[name='permission[]']").val();
//    var permission = new Array();
//     $("#check_permission input:checked").each(function() {
//        permission.push($(this).attr('value'));
//     });
//    // alert(permission);
//      data= {name:name,permission:permission};
//  }

$.ajax({
    url:url,
    type:'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data:data,
    success: function(data) {
        
       if(data.hasOwnProperty('success')){

           location.reload(true);
        }else{

            printErrorMsg(data.error);
        }
    }
});

});
/*end usershifts*/

		$("#edit_company form .submit-btn").click(function(e){

          e.preventDefault();
            
            var title= $("#edit_company form input[name='title']").val();	
		
           // var nearest_branch= $("#edit_company form input[name='nearest_branch']:checked").val();
            var distance= $("#edit_company form input[name='distance']").val();
            var is_fake= $("#edit_company form input[name='is_fake']:checked").val();
			var target_location_check= $("#edit_company form input[name='target_location_check']:checked").val();
  	        var company_logo= $("#edit_company form input[name='company_logo']").val();
            var mac_check= $("#edit_company form input[name='mac_check']:checked").val();
            var add_client= $("#edit_company form input[name='add_client']:checked").val();
            var logout_time= $("#edit_company form input[name='logout_time']").val();
            var min_time= $("#edit_company form input[name='min_time']").val();
            var url=$('#edit_company form').attr('action');
            
//            alert(url); 
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {title:title,logout_time:logout_time,min_time:min_time,/* nearest_branch:nearest_branch ,*/ distance:distance, is_fake:is_fake,target_location_check:target_location_check,company_logo:company_logo,mac_check:mac_check,add_client:add_client},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                        location.reload(true);
                    }
					else
					{
                        printErrorMsg(data.error);
					
                    }
                }
            });

		});
         /*    COMPANY edit */
		$("#edit_company").on('show.bs.modal', function(event) {
                  
    				var button = $(event.relatedTarget) //Button that triggered the modal
    			
    				var getHref = button.data('href'); //get button href
    				
    				var id = button.data('id'); 
                   
                    
    				update_url=baseUrl+"company-update/"+id;    
    				$('#edit_company form').attr('action',update_url);
                    
                    $.ajax({
                    url:getHref,
                   // type:'POST',
    			   // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{id:id},
                    success: function(data) {
                        
    					$.each(data, function( index,company){
  					    var x=company.fake_check;
                        console.log(x);
                          src1=img_url+"public/"+company.logo;
                          $("#edit_company form input[name='title']").val(company.title);	
                        //  $("#edit_company form input[name='nearest_branch']").prop("checked",company.nearest_branch?true:false);
                
                          $("#edit_company form input[name='distance']").val(company.distance);
                          $("#edit_company form input[name='min_time']").val(company.min_time);
                          $("#edit_company form input[name='logout_time']").val(company.logout_time);
                          
                          if(company.fake_check==0?$("#edit_company form .is_fake").prop("checked",true):$("#edit_company form .is_fake1").prop("checked",true));
                        //  if(company.target_location_check==0?$("#edit_company form .target_location").prop("checked",true):$("#edit_company form .target_location1").prop("checked",true));
                        //  if(company.mac_check==0?$("#edit_company form .mac_check").prop("checked",true):$("#edit_company form .mac_check1").prop("checked",true));
                         
                         
                         // $("#edit_company form input[name='is_fake']").prop("checked",company.fake_check?true:false);
    		             // $("#edit_company form input[name='target_location_check']").prop("checked",company.target_location_check?true:false);
                          //$("#edit_company form input[name='mac_check']:checked").val(company.mac_check);
                          //$("#edit_company form input[name='mac_check']").prop("checked",company.mac_check?true:false);
      	                 
                           // $("#edit_company form input[name='company_logo']").val();
    					   $("#edit_company form .preview #img").attr("src", src1);
    						
    					});
                    }
                });   

			});
            
             /* company_admin*/
            
           function goCompany(id){
            
              $.ajax({
                url:baseUrl+'companySet/'+id,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id:id},
                success: function(data) {
                   // alert("jkdfjhfdk");
                    if(data.hasOwnProperty('success')){
				
                       location.reload(baseUrl+"/companies");
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });

            
        }
        
          function goAllCompanyAdmin(){
           $.ajax({
                url:baseUrl+'allCompanyAdmin',
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //data: {id:id},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				         //console.log(baseUrl+"companies");
                      
                      window.location.replace(baseUrl+"companies");
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        }
        /*end*/
            
            /*end edit company*/
            
            /* start edit plan */
            
                      
			$("#edit_plan").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('plan-id'); 
                var type= button.attr('type'); 
				update_url=baseUrl+"plan-update/"+id;
				$('#edit_plan form').attr('action',update_url);
				$.ajax({
					url:getHref,   
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,plan){
                      $("#edit_plan form input[name='currency']").val(plan.currency);	
                      $("#edit_plan form input[name='price_user']").val(plan.price_user);
                       $("#edit_plan form select[name='type']").val(type);
                      		if($("#edit_plan form select[name='type']").val==type){
						
						       $("#edit_plan form select[name='type']").prop('checked', true);
					        }
                     

						
					});
	
				});
			});

         $("#edit_plan button").click(function(e){

              e.preventDefault();
               
                var currency= $("#edit_plan form input[name='currency']").val();	
    		
                var price_user= $("#edit_plan form input[name='price_user']").val();
                var type1= $("#edit_plan form select[name='type']").val();
                // alert(type1);
                var url=$('#edit_plan form').attr('action');
                $.ajax({
                    url:url,
                    type:'POST',  
    			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{currency:currency,price_user:price_user,type:type1},
                    success: function(data) {
                        
                        if(data.hasOwnProperty('success')){
    				
                           location.reload(true);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
    
    		});
            
          $('.expand').click(function(){
            $("input[name='expand']").val("1");
            
            
          }) ;         
            
             /* end edit plan */
                
		$("#add_custom_policy .submit-btn").click(function(e){
            
            e.preventDefault();
           
            var name= $("#add_custom_policy form input[name='name']").val();
            var days= $("#add_custom_policy form input[name='days']").val();
            var leave_type_id= $("#add_custom_policy form select[name='leave_type_id']").val();
		
            
            var  customleave_to= [];

              $("#customleave_select_to option").map(function() {
              customleave_to.push( this.value);
            });
            
            var url=$('#add_custom_policy form').attr('action');
           
            $.ajax({
                url:url,
                type:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {name:name,days:days,leave_type_id:leave_type_id,customleave_to:customleave_to},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });

		});
		$("#edit_custom_policy").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('custompolicy_id'); 

				update_url=baseUrl+"leave/customleave-update/"+id;
				$('#edit_custom_policy form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
				/*.each(data, function( index,custom)
                        $("#add_custom_policy form input[name='name']").val(custom.name);
                        $("#add_custom_policy form input[name='days']").val(custom.days);
                        $("#add_custom_policy form select[name='leave_type_id']").val(custom.leave_type_id);
						
					});*/
	});
				});

              /*    BRANCH edit */
			$("#edit_branch").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('branch-id'); 

				update_url=baseUrl+"branch-update/"+id;
				$('#edit_branch form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
						

					$.each(data, function( index,branch){
					   console.log(branch);					   
						$("#edit_branch").trigger("edit_form_filled",branch);

						$(".branch_title").val(branch.title);
						$(".branch_adress").val(branch.adress);
						$(".edit_lat").val(branch.lati);
						$(".edit_lang").val(branch.longi);
                        
	                        var $newOptionZone = $("<option selected='selected'></option>").val(branch.zone_id).text(branch.zone_name)
 
                           $(".zone_id").append($newOptionZone).trigger('change');
				
						
					});
	
				});
			});

		$("#add_branch button,#edit_branch button").click(function(e){

            e.preventDefault();
           


			var url="";
		    if($(this).attr('type')==="add"){
                url=$('#add_branch form').attr('action');
                var title= $("form input[name='title']").val();	
    			var adress= $("form input[name='adress']").val();
   				var zone_id= $("#add_branch form select[name='zone_id']").val();
    			var add_lat= $("form input[name='add_lat']").val();
    			var add_lang= $("form input[name='add_lang']").val();
			    data= {title:title,adress:adress,add_lat:add_lat,add_lang:add_lang,zone_id:zone_id};
             
             
             }
			if($(this).attr('type')==="edit"){
                       url=$('#edit_branch form').attr('action');
                       var title= $("#edit_branch form input[name='title']").val();	
    			        var adress= $("#edit_branch form input[name='adress']").val();
			 			var edit_lat= $("form input[name='edit_lat']").val();
			            var edit_lang= $("form input[name='edit_lang']").val();
                        var zone_id= $("#edit_branch form select[name='zone_id']").val();
						adress=$(".branch_adress").val();
						data={title:title,adress:adress,edit_lat:edit_lat,edit_lang:edit_lang,zone_id:zone_id};
             }
		
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
                   if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});
		/*     DEPARTMENT edit */
		$("#edit_department").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('dep-id'); 
		   
		
			
		
			update_url=baseUrl+"department-update/"+id;
			$('#edit_department form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function(index,department){
				    console.log(department);
					$( "input[name*='title']" ).val(department.title );
                  

				});

			});
		});
		$("#edit_department button,#add_department button").click(function(e){

            e.preventDefault();
           
            var title= $("form input[name='title']").val();	
			

			var url="";
		    if($(this).attr('type')==="add"){
             url=$('#add_department form').attr('action');
             title= $("#add_department  form input[name='title']").val();
			}
			if($(this).attr('type')==="edit"){
            url=$('#edit_department form').attr('action');
            title= $("#edit_department form input[name='title']").val();
	     	}
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {title:title},
                success: function(data) {
                   
                   if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});


	//job add edit 
	$("#edit_evaluationjob").on('show.bs.modal', function(event) 
    {
            
			 //$(".Checkbox_Evaluation").prop('checked',true);
              $("#edit_evaluationjob .element").attr('checked',false);
              $("#edit_evaluationjob .degree").val('');
              $("#edit_evaluationjob .degree").prop('disabled',true);
			   var button = $(event.relatedTarget) //Button that triggered the modal
		          
		       var	getHref = button.data('href'); //get button href
				
				 var id = button.attr('jobevaluation-id'); 
                    
          
				 update_url=baseUrl+"job-update/"+id;
				 //console.log(update_url);
				 //return;
				 $('#edit_evaluationjob form').attr('action',update_url);
				$.ajax({
					url:getHref,
                   // data:{id:id},
				
					}).done(function(data) {
			        
                    $('#edit_evaluationjob form .modal-title').val(data.jobs.title);
                   // $("#edit_evaluationjob form input[name='target_location1']").prop("checked",data.jobs.target_location_check?true:false);
					if(data.jobs.target_location_check==1?$("#edit_evaluationjob form .target_location1").prop("checked",true):$("#edit_evaluationjob form .target_location").prop("checked",true));
                    	if(data.jobs.client_location_check==1?$("#edit_evaluationjob form .client_location_check1").prop("checked",true):$("#edit_evaluationjob form .client_location_check").prop("checked",true));
					if(data.evaluation_elements=='')
                    {
                         $("#edit_evaluationjob  .table-responsive").hide();
                         $("#edit_evaluationjob  form #elments_empty").css('display','block');
                         $("#edit_evaluationjob   form #Edit_total_sum_value").hide();
                         $("#edit_evaluationjob   form #totlal_degreeelme").hide();
                         $('#edit_evaluationjob form input[name="jobEval_id"]').val(data.jobs.id);

                    }
                   
                  else
                  {
                      $("#edit_evaluationjob  .table-responsive").show();
                       $("#edit_evaluationjob   form #Edit_total_sum_value").show();
                        $("#edit_evaluationjob   form #totlal_degreeelme").show();
                       $("#edit_evaluationjob  form #elments_empty").css('display','none');
                      $('input[name="jobEval_id"]').val(data.jobs.id);
                        var eleme_dgree=JSON.parse(data.jobevalution.element_degree); 
                    	var total=0;			
					    jQuery.each(eleme_dgree, function( i, val ) {
					            
        					 $('input[name="element_id['+i+']"]').attr('checked','checked');
        					  
        					$( "#" + i ).append( document.createTextNode( " - " + val ) );
        					  $('input[name="degree['+i+']"]').val(val);	
                               
                              $('input[name="degree['+i+']"]').prop('disabled',false);	
                              
                              //total += $('input[name="degree['+i+']"]').val(val);
                               total += parseInt($('input[name="degree['+i+']"]').val());
                               $('#Edit_total_sum_value').val(total);
                               
                             
                              
                             
                             });	
                  }
                        });
					       
                             
        });

		$(".editjob-btn,.evaluation-btn").click(function(e){
           
           // console.log('fffgggff');exit;
			e.preventDefault();

			var url='';
			var title='';
            let data={};

		
		    if($(this).attr('type')==="add")
			{
				// title= $("#add_job form input[name='title']").val();
				//  var degree= $("#add_job form input[name='degree[]'").val();
				
				let inputs= $("#add_job form").serializeArray();
				//console.log(inputs);
				inputs.forEach(function(currentValue){
					var key=currentValue.name;
					var value=currentValue.value;
					data[key]=value;
				});
				//console.log(data);
				//return;
				 url=$('#add_job form').attr('action');
             
			}	
			if($(this).attr('type')==="edit")
			{
               url=$('#edit_evaluationjob form').attr('action');
			 //console.log(url);
			//return;
				let inputs=$("#edit_evaluationjob form").serializeArray();
				inputs.forEach(function(currentValue)
				{
					var key=currentValue.name;
					var value=currentValue.value;
					data[key]=value;
		        });
				//console.log(data);
		    }
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
				
                success:function(data) {
					//console.log(data);
					//return;
                 if(data.hasOwnProperty('success')){
					location.reload(true);
                }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});
        
        
    			/*Job DELETE */
	   
		$("#delete_job").on('show.bs.modal', function(event) {
           
		var button = $(event.relatedTarget) //Button that triggered the modal

		var id = button.attr('delete-id');
		del_id=id;
		
	
	
		delete_url=baseUrl+"job-delete";
		
		});
       	$("#delete_job .continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:del_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     location.reload(true);
	
				});

	});
		$("#edit_employee button,#add_employee button").click(function(e){
          
            e.preventDefault();
			
           
		    if($(this).attr('type')=="add"){
				url=$('#add_employee form').attr('action');
				data={name:$( "#add_employee form input[name*='name']" ).val(),
                    email:$( "#add_employee form input[name*='email']" ).val(),
                    active:$( "#add_employee form input[name*='active']:checked" ).val(),
                    bassma:$( "#add_employee form input[name*='bassma']:checked" ).val(),
					password:$( "#add_employee form input[name*='password']" ).val(),
                    confirm_password:$( "#add_employee form input[name*='Confirm_Password']" ).val(),
					joining_date:$( "#add_employee form input[name='joining_date']" ).val(),
                    phone:$( "#add_employee form input[name*='phone']" ).val(),
					job_id:$( "#add_employee form .job_id" ).val(),
					department:$("#add_employee form .department" ).val(),
                    branch:$("#add_employee form select[name='branch']" ).val(),
                    shift_id:$("#add_employee form select[name='shift_id']" ).val(),
                    role_id:$("#add_employee form select[name='role_id']" ).val()
                    }
			}	
			if($(this).attr('type')=="edit"){
               url=$('#edit_employee form').attr('action'),
                data={name:$( "#edit_employee form input[name*='name']" ).val(),
                    email:$( "#edit_employee form input[name*='email']" ).val(),
                    active:$( "#edit_employee form input[name*='active']:checked" ).val(),
                    bassma:$( "#edit_employee form input[name*='bassma']:checked" ).val(),
                    confirm_password:$( "#edit_employee form input[name='Confirm_Password']" ).val(),
					password:$( "#edit_employee form input[name*='password']" ).val(),
					joining_date:$( "#edit_employee form input[name='joining_date']" ).val(),
                    phone:$( "#edit_employee form input[name*='phone']" ).val(),
					job_id:$( "#edit_employee form .job_id" ).val(),
					department:$( "#edit_employee form .department" ).val(),
                    branch:$( "#edit_employee form select[name='branch']" ).val(),
                    shift_id:$("#edit_employee form select[name='shift_id']" ).val(),
                    role_id:$("#edit_employee form select[name='role_id']" ).val(),
                    type:$( "#edit_employee form input[name='type']" ).val(),
                    }
		    }

            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                success: function(data) {
                  
                  // if (data.success!="") {
				   if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }
					else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});

		$("#add_ex_holiday button,#edit_ex_holiday button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_ex_holiday form').attr('action');
				data={title: $("#add_ex_holiday  form input[name='title']").val(),
					date_from:$("#add_ex_holiday  form input[name='date_from']").val(),
					date_to: $("#add_ex_holiday  form input[name='date_to']").val()};
			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_ex_holiday form').attr('action');
                data={title: $("#edit_ex_holiday  form input[name='title']").val(),
				date_from:$("#edit_ex_holiday  form input[name='date_from']").val(),
				date_to: $("#edit_ex_holiday  form input[name='date_to']").val()};
		    }

            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
                 if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});
          /*       START    SHIFTS    */

			$("#add_shift button,#edit_shift button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_shift form').attr('action');
				data={title: $("#add_shift  form input[name='title']").val(),
					from:$("#add_shift  form input[name='from']").val(),
					to: $("#add_shift  form input[name='to']").val(),
					shift_default: $("#add_shift form select[name='shift_default']").val(),
                    time_in_min: $("#add_shift  form input[name='time_in_min']").val(),
                    time_in_max: $("#add_shift  form input[name='time_in_max']").val(),
                    time_out_min: $("#add_shift  form input[name='time_out_min']").val(),
                    time_out_max: $("#add_shift  form input[name='time_out_max']").val(),
                    break_time: $("#add_shift  form input[name='break_time']").val()};
                    
			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_shift form').attr('action');
                data={title: $("#edit_shift  form input[name='title']").val(),
				from:$("#edit_shift form input[name='from']").val(),
				to: $("#edit_shift  form input[name='to']").val(),
				shift_default: $("#edit_shift form select[name='shift_default']").val(),
                time_in_min: $("#edit_shift  form input[name='time_in_min']").val(),
                time_in_max: $("#edit_shift  form input[name='time_in_max']").val(),
                time_out_min: $("#edit_shift  form input[name='time_out_min']").val(),
                time_out_max: $("#edit_shift  form input[name='time_out_max']").val(),
                break_time: $("#edit_shift  form input[name='break_time']").val()};
		    }

            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});
           let status;
		   let shiftt_id;
		$("#approve_shift").on('show.bs.modal', function(event) {
               
			var button = $(event.relatedTarget) //Button that triggered the modal

			 status = button.attr('status');

		     shiftt_id=button.attr('shift_id');
			
		});
		$("#approve_shift .continue-btn").click(function(){
		
     
		$.ajax({
				url:"<?php echo e(route('status-shift',$subdomain)); ?>",    
				data:{status:status,id:shiftt_id},
				type:"get",
				}).done(function(data) {
			     location.reload(true);

			});

		});
        
        	/* shift edit */
		$("#edit_shift").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			     
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('shift-id'); 
			
				
				
				update_url=baseUrl+"shift-update/"+id;
				$('#edit_shift form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,shift){
					    console.log(shift);
						$("#edit_shift form input[name='title']").val(shift.title);
						$("#edit_shift form input[name='from']").val(shift.time_from);
						$("#edit_shift form input[name='to']").val(shift.time_to);
                        $("#edit_shift form input[name='time_in_min']").val(shift.time_in_min);
						$("#edit_shift form input[name='time_in_max']").val(shift.time_in_max);
						$("#edit_shift form input[name='time_out_min']").val(shift.time_out_min);
     	                $("#edit_shift form input[name='time_out_max']").val(shift.time_out_max);
                         $("#edit_shift form input[name='break_time']").val(shift.break_time);
                        //console.log(shift.shift_default);
                         $("#edit_shift form select[name='shift_default']").val(shift.shift_default);
                         $("#edit_shift form select[name='shift_default'] option[value="+shift.shift_default+"]").prop('defaultSelected');
					/*	if(shift.shift_default==1){
						
						        $("#edit_shift form select[name='shift_default']").prop('checked', true);
					    }else{
                            
                            	$("#edit_shift form select[name='shift_default']").prop('checked', false);
						}*/
		                 
						
					});
					
	
				});
			});
            
               /*delete shift*/
               
			 let shift_url;
			    
				$("#delete_shift").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				shift_id=id;
				
			
				
				delete_url=baseUrl+"shift-delete";
			
			});
				 /* end delete shift*/	
			$(".shift-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:shift_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});
                  /*       End    SHIFTS    */ 
                  
                  
     
	$("#edit_schedule").on('show.bs.modal', function(event) {

		var button = $(event.relatedTarget) //Button that triggered the modal
	
		var getHref = button.data('href'); //get button href
		
		var id = button.attr('user_shift-id'); 

		update_url=baseUrl+"usershift/user_shift-update/"+id;
	
		$('#edit_schedule form').attr('action',update_url);
		$.ajax({
			url:getHref,
			data:{id:id},
			}).done(function(user_shift) {
			//$.each(data, function( index,leave){
				console.log(user_shift);
				$("#edit_schedule select[name='user_id']").val(user_shift.user_id);
				$("#edit_schedule input[name='date']").val(user_shift.date);
               	//$("#edit_schedule input[name='date_to']").val(user_shift.date_to);
               	$("#edit_schedule select[name='shift_id']").val(user_shift.shift_id);
                $("#edit_schedule input[name='time_in_min']").val(user_shift.time_in_min);
                $("#edit_schedule input[name='time_in']").val(user_shift.time_in);
               	$("#edit_schedule input[name='time_in_max']").val(user_shift.time_in_max);				
               	$("#edit_schedule input[name='time_out_min']").val(user_shift.time_out_min);
				$("#edit_schedule input[name='time_out']").val(user_shift.time_out);
				$("#edit_schedule input[name='time_out_max']").val(user_shift.time_out_max);	
				$("#edit_schedule input[name='break_time']").val(user_shift.break_time);
                $("#edit_schedule form input[name='over_time']").val(user_shift.over_time);
                
                 
				$("#edit_schedule input[name='active']").val(user_shift.active);
		
		//	});

		});
	});
		$("#add_leave button,#edit_leave button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_leave form').attr('action');
				data={user_id:$("#add_leave select[name='user_id']").val(),
						type:$("#add_leave select[name='type']").val(),
						leave_from:$("#add_leave input[name='leave_from']").val(),
						leave_to:$("#add_leave input[name='leave_to']").val(),	
						days:$("#add_leave input[name='days']").val(),
						leave_reson:$("#add_leave textarea[name='leave_reson']").val()};

			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_leave form').attr('action');
               data={user_id:$("#edit_leave select[name='user_id']").val(),
						type:$("#edit_leave select[name='type']").val(),
						leave_from:$("#edit_leave input[name='leave_from']").val(),
						leave_to:$("#edit_leave input[name='leave_to']").val(),
						days:$("#edit_leave input[name='days']").val(),
						leave_reson:$("#edit_leave textarea[name='leave_reson']").val()};
		    }

            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});

		$("#delete_leave").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				leave_id=id;
				
			
				
				delete_url=baseUrl+"leaves-delete";
			
			});
			$(".leave-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:leave_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});

		$("#add_task button,#edit_task button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_task form').attr('action');
				data={user_id:$("#add_task select[name='user_id']").val(),
						title:$("#add_task input[name='title']").val(),
						start_date:$("#add_task input[name='start_date']").val(),
						due_date:$("#add_task input[name='due_date']").val(),
                        description:$("#add_task textarea[name='description']").val()};

			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_task form').attr('action');
               data={user_id:$("#edit_task select[name='user_id']").val(),
						title:$("#edit_task input[name='title']").val(),
						start_date:$("#edit_task input[name='start_date']").val(),
						due_date:$("#edit_task input[name='due_date']").val(),
						description:$("#edit_task textarea[name='description']").val()};
		    }
              
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});
		$("#add_outdoor button,#edit_outdoor button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_outdoor form').attr('action');
				data={
						title:$("#add_outdoor input[name='title']").val(),
     	                //date_to:$("#add_outdoor input[name='date_to']").val(),
						date:$("#add_outdoor input[name='date']").val(),
						add_lat:$("#add_outdoor input[name='date_from']").val(),
                       	user_id:$("#add_outdoor select[name='user_id']").val(),
					/*	add_lat:$("#add_outdoor input[name='add_lat']").val(),
						add_lang:$("#add_outdoor  input[name='add_lang']").val(),
						adress:$("#add_outdoor input[name='adress']").val(),*/
						visit_type_id:$("#add_outdoor select[name='visit_type_id']").val(),
						customer_id:$("#add_outdoor select[name='customer_id[]']").val(),
                       	branch:$("#add_outdoor select[name='branch']").val(),
                        description:$("#add_outdoor textarea[name='description']").val()};

			}	
			if($(this).attr('type')==="edit"){
			
			    			lang=$("#edit_outdoor input[name='add_lang']").val();
                			lat=$("#edit_outdoor input[name='add_lat']").val();
                            myLatlng ={lat:lat,lng:lang};
                           // alert(myLatlng);
                            console.log(myLatlng);
			// alert($("#edit_outdoor select[name='user_id']").val());
               url=$('#edit_outdoor form').attr('action');
               data={
						title:$("#edit_outdoor input[name='title']").val(),
						//date_to:$("#edit_outdoor input[name='date_to']").val(),
						date:$("#edit_outdoor input[name='date']").val(),
     	                user_id:$("#edit_outdoor select[name='user_id']").val(),
					/*	add_lat:$("#edit_outdoor input[name='add_lat']").val(),
						add_lang:$("#edit_outdoor input[name='add_lang']").val(),*/
						visit_type_id:$("#edit_outdoor select[name='visit_type_id']").val(),
						customer_id:$("#edit_outdoor select[name='customer_id']").val(),
						user_id:$("#edit_outdoor select[name='user_id']").val(),
						//adress:$("#edit_outdoor input[name='adress']").val(),
                        old_customer:$("#edit_outdoor input[name='customer_id']").val(),                        
                        description:$("#edit_outdoor textarea[name='description']").val(),
                       	branch:$("#edit_outdoor select[name='branch']").val(),
                        };
		    }
              
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
						if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});


			/*    outdoor type edit */
		$("#add_outdoor_type button,#edit_outdoor_type button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_outdoor_type form').attr('action');
				data={name:$("#add_outdoor_type input[name='name']").val()};
			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_outdoor_type form').attr('action');
               data={name:$("#edit_outdoor_type input[name='name']").val()};
             }
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});
					/*    outdoor type edit */
		$("#add_visit_question button,#edit_visit_question button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_visit_question form').attr('action');
                data={visit_type:$("#add_visit_question select[name='visit_type']").val(),que_type:$("#add_visit_question select[name='que_type']").val(),question_text:$("#add_visit_question input[name='question_text']").val()
			         ,choose1:$("#add_visit_question input[name='choose1']").val(),choose2:$("#add_visit_question input[name='choose2']").val(),choose3:$("#add_visit_question input[name='choose3']").val(),choose4:$("#add_visit_question input[name='choose4']").val()};
			}	
			if($(this).attr('type')==="edit"){
                url=$('#edit_visit_question form').attr('action');
                data={visit_type:$("#edit_visit_question select[name='visit_type']").val(),que_type:$("#edit_visit_question select[name='que_type']").val(),question_text:$("#edit_visit_question input[name='question_text']").val()
			         ,choose1:$("#edit_visit_question input[name='choose1']").val(),choose2:$("#edit_visit_question input[name='choose2']").val(),choose3:$("#edit_visit_question input[name='choose3']").val(),choose4:$("#edit_visit_question input[name='choose4']").val()};
             }
			
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});

/**
 * START CLIEN
 */
	$("#add_client button,#edit_client button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')=="add"){
				// url=$('#add_client form').attr('action');
                // data={name:$("#add_client input[name='name']").val(),phone:$("#add_client input[name='phone']").val(),client_type_id:$("#add_client select[name='client_type_id']").val(),contact_person:$("#add_client input[name='contact_person']").val()
			    //      ,contact_phone:$("#add_client input[name='contact_phone']").val(),address:$("#add_client input[name='address']").val(),add_lat:$("#add_client input[name='add_lat']").val(),email:$("#add_client input[name='email']").val(),start_time:$("#add_client input[name='start_time']").val(),add_lang:$("#add_client input[name='add_lang']").val(),end_time:$("#add_client input[name='end_time']").val(),branch:$("#add_client select[name='branch']").val(),'target':$("#add_client input[name='target_vists']").val()};
				url=$('#add_client form').attr('action');
				$specializations=$("#add_client select[name='specializations_id']").val();
				if($specializations=='all')$specializations='';
             //alert($("#add_client select[name='day[]']").map(function(){return $(this).val();}).get());
				// console.log($specializations);
				// return;
				// data={name:$("#add_client input[name='name']").val(),phone:$("#add_client input[name='phone']").val(),client_type_id:$("#add_client select[name='client_type_id']").val(),contact_person:$("#add_client input[name='contact_person']").val()
			    //      ,contact_phone:$("#add_client input[name='contact_phone']").val(),address:$("#add_client input[name='address']").val(),add_lat:$("#add_client input[name='add_lat']").val(),email:$("#add_client input[name='email']").val(),start_time:$("#add_client input[name='start_time']").val(),add_lang:$("#add_client input[name='add_lang']").val(),end_time:$("#add_client input[name='end_time']").val(),branch:$("#add_client select[name='branch']").val(),'target':$("#add_client input[name='target_vists']").val()
				// 	 ,specializations_id:$("#add_client select[name='specializations_id']").val()};
                data={name:$("#add_client input[name='name']").val(),phone:$("#add_client input[name='phone']").val(),client_type_id:$("#add_client select[name='client_type_id']").val(),contact_person:$("#add_client input[name='contact_person']").val()
			         ,contact_phone:$("#add_client input[name='contact_phone']").val(),address:$("#add_client input[name='address']").val(),add_lat:$("#add_client input[name='add_lat']").val(),email:$("#add_client input[name='email']").val(),add_lang:$("#add_client input[name='add_lang']").val(),branch:$("#add_client select[name='branch']").val(),'target':$("#add_client input[name='target_vists']").val()
					 ,specializations_id:$specializations,day:$("#add_client select[name='day[]']").map(function(){return $(this).val();}).get(),start_time:$("#add_client input[name='start_time[]']").map(function(){return $(this).val();}).get(),end_time:$("#add_client input[name='end_time[]']").map(function(){return $(this).val();}).get()};

			}	
			if($(this).attr('type')=="edit"){
                url=$('#edit_client form').attr('action');
                data={name:$("#edit_client input[name='name']").val(),phone:$("#edit_client input[name='phone']").val(),client_type_id:$("#edit_client select[name='client_type_id']").val()
			         ,contact_person:$("#edit_client input[name='contact_person']").val(),contact_phone:$("#edit_client input[name='contact_phone']").val(),address:$("#edit_client input[name='address']").val(),add_lat:$("#edit_client input[name='add_lat']").val(),email:$("#edit_client input[name='email']").val(),/*start_time:$("#edit_client input[name='start_time']").val(),*/add_lang:$("#edit_client input[name='add_lang']").val()/*,end_time:$("#edit_client input[name='end_time']").val()*/,branch:$("#edit_client select[name='branch']").val(),'target':$("#edit_client input[name='target_vists']").val()
					 ,specializations_id:$("#edit_client select[name='specializations_id']").val(),day:$("#edit_client select[name='day[]']").map(function(){return $(this).val();}).get(),start_time:$("#edit_client input[name='start_time[]']").map(function(){return $(this).val();}).get(),end_time:$("#edit_client input[name='end_time[]']").map(function(){return $(this).val();}).get()};
			
            }
			
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                     
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});
        /* 
        add client to outdoor start
        */
        
     $("#add_edit_client").on('show.bs.modal', function(event) {
                   
				          
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('outdoor_id'); 
			
				update_url=baseUrl+"outdoor-update-client/"+id;
				$('#add_edit_client form').attr('action',update_url);
                 $.ajax({
					url:getHref,
					
					}).done(function(data) {
				
					$.each(data, function( index,outdoor){
                          var $newOptionClient = $("<option selected='selected'></option>").val(outdoor.customer_id).text(outdoor.client_name)
 
                           $(".client_name_branch").append($newOptionClient).trigger('change');

                    });
                    });
                    });
                $("#add_edit_client button").click(function(e){
           
                     e.preventDefault();
          	         url=$('#add_edit_client form').attr('action');
                     data={customer_id:$("#add_edit_client select[name='customer_id']").val()};
                     $.ajax({
                        url:url,
                        type:'POST',
        			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:data,
                        success: function(data) {
                           
        					if(data.hasOwnProperty('success')){
        					
        						location.reload(true);
        					}else{
        						
        						printErrorMsg(data.error);
        					}
                        }
                    });
                     
                     });

     
                /**
                    * rate model start
                */   
             $("#add_edit_rate").on('show.bs.modal', function(event) {
                   
				          
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('outdoor_id'); 
			
				update_url=baseUrl+"outdoor-update-rate/"+id;
				$('#add_edit_rate form').attr('action',update_url);
                 $.ajax({
					url:getHref,
					
					}).done(function(data) {
				              
		                 $("#add_edit_rate input[name='rate_value']").val(data[0].rate);
                    });
                    });            
                $("#add_edit_rate button").click(function(e){
           
                     e.preventDefault();
          	         url=$('#add_edit_rate form').attr('action');
                     data={rate:$("#add_edit_rate input[name='rate_value']").val()};
                     $.ajax({
                        url:url,
                        type:'POST',
        			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:data,
                        success: function(data) {
                           
        					if(data.hasOwnProperty('success')){
        					
        						location.reload(true);
        					}else{
        						
        						printErrorMsg(data.error);
        					}
                        }
                    });
                     
                     });


			/*    outdoor type edit */
		$("#add_client_type button,#edit_client_type button").click(function(e){
           
            e.preventDefault();
              
		    if($(this).attr('type')==="add"){
				url=$('#add_client_type form').attr('action');
				data={name:$("#add_client_type input[name='name']").val()};
			}	
			if($(this).attr('type')==="edit"){
               url=$('#edit_client_type form').attr('action');
               data={name:$("#edit_client_type input[name='name']").val()};
             }
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
					if(data.hasOwnProperty('success')){
					
						location.reload(true);
					}else{
						
						printErrorMsg(data.error);
					}
                }
            });

		});
        
            // client add appoint*/
	var i_client=1;
     function add_client_sch(selector){
          // alert("4");
		    id=$("#"+selector+" .client_sch").last().attr('id');
		
    		//	var split_id = id.split("_");
    		//	var deleteindex = split_id[1];
		    i_client=id;
		    ++i_client;
             
	     	$("#"+selector+" .client_sch").last().after('<div class="client_sch appoint_'+i_client+' row" id="'+i_client+'" ><div class="col-sm-4"> <label class="col-form-label"><?php echo e(__("trans.day")); ?> <span class="text-danger" >*</span></label><select class="select day_'+i_client+'" name="day[]"><option value="6"><?php echo e(__("trans.saturday")); ?></option><option value="0"><?php echo e(__("trans.sunday")); ?></option><option value="1"><?php echo e(__("trans.monday")); ?></option><option value="2"><?php echo e(__("trans.thursday")); ?></option><option value="3"><?php echo e(__("trans.wednsday")); ?></option><option value="4"><?php echo e(__("trans.tuesday")); ?></option><option value="5"><?php echo e(__("trans.friday")); ?></option></select></div><div class="col-sm-3"><label><?php echo e(__("trans.From")); ?> <span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="start_time[]"/></div></div><div class="col-sm-3"><label><?php echo e(__("trans.To")); ?><span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="end_time[]"/></div></div><div class="col-sm-2" onclick="delete_appoint('+i_client+');"><i class="fa fa-minus"></i></div></div>');
     }
     
       // client delete appoint*/
     function delete_appoint(appoint){
        alert(appoint);
        $(".appoint_"+appoint).remove();
     }
     
	function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
			/* Branch DELETE */
			    let delete_url;
			    let del_id;
				$("#delete_branch").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
				del_id=id;
				
			
			
				delete_url=baseUrl+"branch-delete";
			
			});
			$("#delete_branch .continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:del_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     location.reload(true);
	
				});

			});
		</script>

	
		<script>
		/*    Employee edit */
		$("#edit_employee").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('employee-id'); 
		   
		
			
		
			update_url=baseUrl+"employee-update/"+id;
			$('#edit_employee form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,employee){
				  console.log(employee);
					$( "input[name*='name']" ).val(employee.name );
                    $( "input[name*='email']" ).val(employee.email );
                    $( "input[name*='active']" ).prop("checked",employee.active?true:false);
                    $( "input[name*='bassma']" ).prop("checked",employee.bassma?true:false);
					$( "input[name*='old_password']" ).val(employee.password );
					$( "input[name='joining_date']" ).val(employee.join_date );
                    $( "input[name*='phone']" ).val(employee.phone);
					$( "select[name='job_id']" ).val(employee.job_id);
						$( "select[name='job_id']" ).val(employee.job_id).change();
					
				    	$( "#edit_employee select[name='department']" ).val(employee.department_id);
                      	$( "#edit_employee select[name='department']" ).val(employee.department_id).change();
                    	
                    $( "select[name='branch']" ).val(employee.branch_id );
                      $( "select[name='branch']" ).val(employee.branch_id ).change();
                      
                   	$( "select[name='role_id']" ).val(employee.role_id);
                   	$( "select[name='role_id']" ).val(employee.role_id).change();
                   		
                   	$( "select[name='shift_id']" ).val(employee.shift_id);
              	$( "select[name='shift_id']" ).val(employee.shift_id).change();
				});

			});
		});
		/* employee_end*/
		/*employee delete*/
		    let user_delete_url;
			    let user_del_id;
				$("#delete_employee").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
				user_del_id=id;
				
				
			
				
				user_delete_url=baseUrl+"employee-delete";
			
			});
			$("#delete_employee .continue-btn").click(function(){
         
			$.ajax({
					url:user_delete_url,    
					data:{id:user_del_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     location.reload(true);
	
				});

			});	
		</script>
		<script>
		 /*    exception_holidays edit */
			$("#edit_ex_holiday").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('ex_holiday-id'); 
			
				
				update_url=baseUrl+"exception-holidays-update/"+id;
				$('#edit_ex_holiday form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,ex_holiday){
					  console.log(ex_holiday);
						$("input[name='title']").val(ex_holiday.title);
						$("input[name='date_from']").val(ex_holiday.date_from);
						$("input[name='date_to']").val(ex_holiday.date_to);
						
					});
	
				});
			});

			/*exception_holidays delete*/

			    let ex_holidaydelete_url;
			    let ex_holidaydel_id;
				$("#delete_ex_holiday").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
				ex_holidaydel_id=id;
				
			
				
				delete_url=baseUrl+"exception-holidays-delete";
			
			});
			$("#delete_ex_holiday .continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:ex_holidaydel_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     location.reload(true);
	
				});

			});



            /* store fixed holiday*/
            
            $("#add_holiday button,#edit_fix_holiday button").click(function(e){
           
                     e.preventDefault();
          	         
                     
                     
                        var day_add = {};
                     if($(this).attr('type')==="add"){
                        url=$('#add_holiday form').attr('action');
                        var ser_form = $("#add_holiday form").serializeArray();
                        }else{
                            url=$('#edit_fix_holiday form').attr('action');
                           var ser_form = $("#edit_fix_holiday form").serializeArray();
         
                        }
                        $.each(ser_form, function() {
                            if (day_add[this.name] !== undefined) {
                                if (!day_add[this.name].push) {
                                    day_add[this.name] = [day_add[this.name]];
                                }
                                day_add[this.name].push(this.value || '');
                            } else {
                                day_add[this.name] = this.value || '';
                            }
                        });
                        console.log(day_add);
                     
             // .map(function(){return $(this).val();}).get()};
             // console.log(data);
                     $.ajax({
                        url:url,
                        type:'POST',
        			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:day_add,
                        success: function(data) {
                           
        					if(data.hasOwnProperty('success')){
        					
        						location.reload(true);
        					}else{
        						
        						printErrorMsg(data.error);
        					}
                        }
                    });
                     
                     });
			/* edit fix holiday*/
			 
			$("#edit_fix_holiday").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('fix_holiday-id'); 
			
				
				update_url=baseUrl+"fixed-holidays-update/"+id;
				$('#edit_fix_holiday form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(fix_holiday) {
					  day=JSON.parse(fix_holiday.fix_holiday.day);
					  console.log(day);
					  jQuery.each(day, function( i, val ) {
					    
  					//	i = i.replace(/"|'/g,'');
						//console.log(i);
					 $('input[name="day['+i+']"]').attr('checked','checked');
					  
																																																																											$( "#" + i ).append( document.createTextNode( " - " + val ) );
																																																																											});
						
						
					
	
				});
			});

	/*fix_holidays delete*/

			    let fix_holidaydelete_url;
			    let fix_holidaydel_id;
			$("#delete_fix_holiday").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
				fix_holidaydel_id=id;
				
			
				
				delete_url=baseUrl+"fixed-holidays-delete";
			
			});
			$("#delete_fix_holiday .continue-btn").click(function(){
             
			$.ajax({
					url:delete_url,    
					data:{id:fix_holidaydel_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     location.reload(true);
	
				});

			});

		/* workflow  */

               		 /*   view overflow edit */
			$("#view_workflow_shift").on('show.bs.modal', function(event) {
                
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				var getnumber = button.data('number');
				var id = button.attr('work_flow-id'); 
			
			
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,workflow){
				
					$("#view_workflow_shift .view_workflow_append").append('<div class="card card-body"><h5 class="card-title" style="text-align:center">'+workflow.shift_title+' <small class="text-muted"></small></h5><div class="punch-det"><h6><?php echo e(__("trans.type")); ?></h6><p id="punch_in">'+workflow.type+'</p></div><div class="punch-hours" style="float:left;"><h6><?php echo e(__("trans.hours")); ?></h6><span>'+workflow.hours+' hrs</span></div><div class="punch-hours"><h6 ><?php echo e(__("trans.mints")); ?></h6><p>'+workflow.minutes+'</p></div><div class="punch-det" style=""><h6 ><?php echo e(__("trans.description")); ?></h6>'+workflow.description+'</div></div>');
					  
						/*$("input[name='title']").val(ex_holiday.title);
						$("input[name='date_from']").val(ex_holiday.date_from);
						$("input[name='date_to']").val(ex_holiday.date_to);*/
						
					});
					//console.log(data);
	
				});
			});
            /* end view workflow*/
		var i=1;
		function add_flow(){
	
			if ($("#overflow .delete_flow").length ) {
		    id=$("#overflow div .delete_flow").last().attr('id');
			
			var split_id = id.split("_");
			var deleteindex = split_id[1];
			i=deleteindex;
			   ++i;
			$(".edit_workflow_append").append('<div class=" col-sm-12 col-lg-12 col-md-12 workflowdelete'+i+'" style="border:1px solid" ><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.type")); ?> <span class="text-danger">*</span></label> <select class="form-control" name="type[]"><option value="overtime"><?php echo e(__("trans.overtime")); ?> </option> <option value="before_leave"><?php echo e(__("trans.beforetime")); ?> </option> <option value="late"><?php echo e(__("trans.late")); ?> </option>  </select></div><div class="col-sm-6 col-lg-6 col-md-6"> <label class="col-form-label"><?php echo e(__("trans.mints")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="mints[]"></div><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.hours")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="hours[]"></div> <div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.desc")); ?> <span class="text-danger">*</span></label><input class="form-control" type="text" name="desc[]"> </div><a href="javascript:void(0);" style="cursor:pointer" class="delete_flow"  id="deleteflow_'+i+'"><?php echo e(__("trans.Delete")); ?></a></div>  </div>   </div>');
			}else{
			
			++i;
			
			$("#overflow").append('<div class=" col-sm-12 col-lg-12 col-md-12 workflowdelete'+i+'" style="border:1px solid" ><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.type")); ?> <span class="text-danger">*</span></label> <select class="form-control" name="type[]"><option value="overtime"><?php echo e(__("trans.overtime")); ?> </option> <option value="before_leave"><?php echo e(__("trans.beforetime")); ?> </option> <option value="late"><?php echo e(__("trans.late")); ?> </option>  </select></div><div class="col-sm-6 col-lg-6 col-md-6"> <label class="col-form-label"><?php echo e(__("trans.mints")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="mints[]"></div><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.hours")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="hours[]"></div> <div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.desc")); ?> <span class="text-danger">*</span></label><input class="form-control" type="text" name="desc[]"> </div><a href="javascript:void(0);" style="cursor:pointer" class="delete_flow"  id="deleteflow_'+i+'"><?php echo e(__("trans.Delete")); ?></a></div>  </div>   </div>');
			}
		}
	
   
		
		$('#overflow').on('click','.delete_flow',function(){
			id=$(this).attr('id');
			  var split_id = id.split("_");
			  var deleteindex = split_id[1];

			  // Remove <div> with id
			  $(".workflowdelete" + deleteindex).remove();
		});
		$('#overflow .edit_workflow_append').on('click','.delete_flow',function(){
			id=$(this).attr('id');
			  var split_id = id.split("_");
			  var deleteindex = split_id[1];

			  // Remove <div> with id
			  $(".workflowdelete" + deleteindex).remove();
		});
     

        
		 /*    overflow edit */
			$("#edit_workflow").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
   	            var number = button.data('number'); //get button href
				
				var id = button.attr('work_flow-id'); 
                update_url==baseUrl+'workflow-update/'+id;
			    $("#edit_workflow form").attr('action',update_url);
                
			
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,workflow){
					console.log(workflow);
					$(".edit_workflow_append").append('<div class=" col-sm-12 col-lg-12 col-md-12 workflowdelete'+index+'" style="border:1px solid" ><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.type")); ?> <span class="text-danger">*</span></label> <select class="form-control" name="type[]"><option value="overtime"><?php echo e(__("trans.overtime")); ?> </option> <option value="before_leave"><?php echo e(__("trans.beforetime")); ?> </option> <option value="late"><?php echo e(__("trans.late")); ?> </option>  </select></div><div class="col-sm-6 col-lg-6 col-md-6"> <label class="col-form-label"><?php echo e(__("trans.mints")); ?> <span class="text-danger">*</span></label><input class="form-control" value="'+workflow.mints+'"type="number" name="mints[]"></div><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.hours")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" value="'+workflow.hours+'" name="hours[]"></div> <div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.desc")); ?> <span class="text-danger">*</span></label><input class="form-control" type="text" value="'+workflow.description+'" name="desc[]"> </div></div>  </div>   </div>');
					  
						/*$("input[name='title']").val(ex_holiday.title);
						$("input[name='date_from']").val(ex_holiday.date_from);
						$("input[name='date_to']").val(ex_holiday.date_to);*/
						
					});
					//console.log(data);
	
				});
			});
            		 /*    overflow edit */
			$("#_viewworkflow").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				var getnumber = button.data('number');
				var id = button.attr('work_flow-id'); 
			
			
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,workflow){
				
					$(".edit_workflow_append").append('<div class=" col-sm-12 col-lg-12 col-md-12 workflowdelete'+index+'" style="border:1px solid" ><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.type")); ?> <span class="text-danger">*</span></label> <select class="form-control" name="type[]"><option value="overtime"><?php echo e(__("trans.overtime")); ?> </option> <option value="before_leave"><?php echo e(__("trans.beforetime")); ?> </option> <option value="late"><?php echo e(__("trans.late")); ?> </option>  </select></div><div class="col-sm-6 col-lg-6 col-md-6"> <label class="col-form-label"><?php echo e(__("trans.mints")); ?> <span class="text-danger">*</span></label><input class="form-control" value="'+workflow.mints+'"type="number" name="mints[]"></div><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.hours")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" value="'+workflow.hours+'" name="hours[]"></div> <div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.desc")); ?> <span class="text-danger">*</span></label><input class="form-control" type="text" value="'+workflow.description+'" name="desc[]"> </div></div>  </div>   </div>');
					  
						/*$("input[name='title']").val(ex_holiday.title);
						$("input[name='date_from']").val(ex_holiday.date_from);
						$("input[name='date_to']").val(ex_holiday.date_to);*/
						
					});
					//console.log(data);
	
				});
			});

			/*delete*/
			 let workflow_url;
			    let shift_id;
				$("#delete_workflow_shift").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
				
				shift_id=id;
				
			
				
				delete_url=baseUrl+"workflow-delete";
			
			});
		
			$(".workflow-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:shift_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});
			/*shifts*/
			$(document).ready(function() {
		/*	$('#from_time').timepicker({
				twelvehour: false,
				min: "8:20am",
				max: "5:15pm"
			});*/
			});

		  
			   let client_id;
			$("#approve_client").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				 status = button.attr('status');

			     cli_id=button.attr('client_id');
				
			});
			$("#approve_client .continue-btn").click(function(){
			
         
			$.ajax({
					url:"<?php echo e(route('status-client',$subdomain)); ?>",    
					data:{status:status,id:cli_id},
					type:"get",
					}).done(function(data) {
				     location.reload(true);
	
				});

			});

			/*task shift */
			$("#edit_task").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			     
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('task-id'); 
			
				
				
				update_url=baseUrl+"task-update/"+id;
				$('#edit_task form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,task){
					console.log(task);
						$("input[name='title']").val(task.title);
						$("input[name='start_date']").val(task.start_date);
						
						//$("input[name='user_id']").val(task.user_id);
						
						$("select[name='user_id']").val(task.user_id);
						$( "select[name='user_id']" ).val(task.user_id).change();
						
						$("input[name='due_date']").val(task.due_date);
						$("textarea[name='description']").val(task.description);
						
					});
					
	
				});
			});

			 let task_url;
		
				$("#delete_task").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				task_id=id;
				
			
				
				delete_url=baseUrl+"task-delete";
			
			});
			$(".task-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:task_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});

		/*  outdoor edit */
			$("#edit_outdoor_type").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('outdoor-type-id'); 
			
				
				update_url=baseUrl+"outdoor-type-update/"+id;
				$('#edit_outdoor_type form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,outdoor_type){
					 
						$("input[name='name']").val(outdoor_type.name);
			
					});
	
				});
			});
				/*  outdoor edit */
			$("#edit_outdoor").on('show.bs.modal', function(event) {
                         
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('outdoor-id'); 
			
				
				update_url=baseUrl+"outdoor-update/"+id;
				$('#edit_outdoor form').attr('action',update_url);
				

				
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
						$("#edit_outdoor").trigger("edit_form_filled",data);

					$.each(data, function( index,outdoor){
					
						console.log(outdoor);
                      
                        
			            $("#edit_outdoor  input[name='title']").val(outdoor.title);
						//$("#edit_outdoor  input[name='date_to']").val(outdoor.date_to);
						$("#edit_outdoor  input[name='date']").val(outdoor.date);
					/*	$("#edit_outdoor  input[name='add_lat']").val(outdoor.lati);
						$("#edit_outdoor   input[name='add_lang']").val(outdoor.longi);
						$("#edit_outdoor  input[name='adress']").val(outdoor.adress);*/
						$("#edit_outdoor  input[name='customer_id']").val(outdoor.customer_id)
     	                $("#edit_outdoor  input[name='user_id']").val(outdoor.user_id);
                        $("#edit_outdoor  select[name='branch']").val(outdoor.branch_id);
                        $("#edit_outdoor  select[name='branch']").val(outdoor.branch_id).change();
                       
                      //   $("#edit_outdoor  select[name='branch']").change(function(){
                    //   $("#edit_outdoor  select[name='branch']").prop('selectedIndex',0);
                    //   });
                      	$("#edit_outdoor  select[name='visit_type_id']").val(outdoor.visit_type_id);
						$("#edit_outdoor  select[name='visit_type_id']").val(outdoor.visit_type_id).change();
						   
                     
                       
                        $("#edit_outdoor  textarea[name='description']").val(outdoor.description);
                       
                        var $newOption = $("<option selected='selected'></option>").val(outdoor.user_id).text(outdoor.user_name)
 
                           $(".employee_name_branch").append($newOption).trigger('change');
                        var $newOptionClient = $("<option selected='selected'></option>").val(outdoor.customer_id).text(outdoor.client_name)
 
                           $(".client_name_branch").append($newOptionClient).trigger('change');
					});
	
				});
			});
		    let outdoor_type_url;
		
				$("#delete_outdoor_type").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				outdoor_type_id=id;
				
			
				
				delete_url=baseUrl+"outdoor-type-delete";
			
			});
			$(".outdoor-type-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:outdoor_type_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});
            
            
           $("#delete_outdoor").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				outdoor_id=id;
				
			
				
				delete_url=baseUrl+"outdoor-delete";
			
			});
			$(".outdoor-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:outdoor_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});
			/* question */

       $('.que_type').change(function() {
            question_type=$(this).val();
			if(question_type=="mcq"){
			   $(".msq_answer").show();
			   $(".msq_answer").removeAttr("disabled");
			}else{
               $(".msq_answer").hide();
			   $(".msq_answer").attr("disabled","disabled");
			}
         });
			/*  question edit */
			$("#edit_visit_question").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('visitquestion-id'); 
			
				
				update_url=baseUrl+"visitquestion-update/"+id;
				$('#edit_visit_question form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data,function(index,visit_que){
						if(visit_que.type=="msq"){
							$(".msq_answer").show();
							$(".msq_answer").removeAttr("disabled");
						}else{
							$(".msq_answer").hide();
							 $(".msq_answer").attr("disabled","disabled");

						}
						$("input[name='']").val(visit_que.name);
						
						$("select[name='visit_type']").val(visit_que.visit_type_id);
							$("select[name='visit_type']").val(visit_que.visit_type_id).change();
							
						$("select[name='que_type']").val(visit_que.type);
						$("select[name='que_type']").val(visit_que.type).change();
						
						
						$("input[name='question_text']").val(visit_que.question_text);
						$("input[name='choose1']").val(visit_que.choose_1);
						$("input[name='choose2']").val(visit_que.choose_2);
						$("input[name='choose3']").val(visit_que.choose_3);
						$("input[name='choose4']").val(visit_que.choose_4);
					    
						
					});
	
				});
			});
			/* delete question*/
              
			 let visit_que_url;
		
				$("#delete_visit_question").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id = button.attr('delete-id');
			
				visit_question_id=id;
				
			
				
				delete_url=baseUrl+"visitquestion-delete";
			
			});
			$(".visit_question-continue-btn").click(function(){
         
			$.ajax({
					url:delete_url,    
					data:{id:visit_question_id},
				    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});

	
   
		function add_question_answer(){
	        
			if ($("#msq_answer .delete_flow").length ) {
		    id=$("#msq_answer div .delete_flow").last().attr('id');
			
			var split_id = id.split("_");
			var deleteindex = split_id[1];
			i=deleteindex;
			   ++i;
			$(".edit_workflow_append").append('<div class=" col-sm-12 col-lg-12 col-md-12 workflowdelete'+i+'" style="border:1px solid" ><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.type")); ?> <span class="text-danger">*</span></label> <select class="form-control" name="type[]"><option value="overtime"><?php echo e(__("trans.overtime")); ?> </option> <option value="before_leave"><?php echo e(__("trans.beforetime")); ?> </option> <option value="late"><?php echo e(__("trans.late")); ?> </option>  </select></div><div class="col-sm-6 col-lg-6 col-md-6"> <label class="col-form-label"><?php echo e(__("trans.mints")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="mints[]"></div><div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.hours")); ?> <span class="text-danger">*</span></label><input class="form-control" type="number" name="hours[]"></div> <div class="col-sm-6 col-lg-6 col-md-6"><label class="col-form-label"><?php echo e(__("trans.desc")); ?> <span class="text-danger">*</span></label><input class="form-control" type="text" name="desc[]"> </div><a href="javascript:void(0);" style="cursor:pointer" class="delete_flow"  id="deleteflow_'+i+'"><?php echo e(__("trans.Delete")); ?></a></div>  </div>   </div>');
			}else{
			
			++i;
			
			$("#msq_answer").append('<div class="msq_answer"><div class="col-sm-6"> <div class="form-group"> <label class="col-form-label"><?php echo e(__('trans.add choose1')); ?> <span class="text-danger" >*</span></label><input class="form-control add_lat" type="text" name="choose1" > </div> </div> <div class="col-sm-6"> <div class="form-group"><label class="col-form-label"><?php echo e(__('trans.add choose2')); ?> <span class="text-danger" >*</span></label> <input class="form-control choose2" type="text" name="choose2" ></div></div> <div class="col-sm-6"><div class="form-group"> <label class="col-form-label"><?php echo e(__('trans.add choose3')); ?> <span class="text-danger" >*</span></label> <input class="form-control add_lat" type="text" name="choose3" > </div> </div><div class="col-sm-6"><div class="form-group"> <label class="col-form-label"><?php echo e(__('trans.add choose4')); ?> <span class="text-danger" >*</span></label>  <input class="form-control choose2" type="text" name="choose4" > </div>  </div> </div>');
			}
		}

		/* switch 
			("#customSwitch1").change(function(){
				$("#valueOfSwitch1").html("false");
				if ($(this).is(':checked')) {
					$("#valueOfSwitch1").html("true");
				}
		    });	*/

			/*delete user shift*/
			$(".user_shift-continue-btn").click(function(){
         	    getUrl=window.location;
				
		     	$.ajax({
					url:baseUrl+"usershift/schedule-delete",    
					data:{id:$(this).attr('delete-id')},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

			});

			/*attendance details*/

					
			$("#attendance_info").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var user_id = button.attr('user_id');
				var day = button.attr('day');
                var date = button.attr('date');
                // alert(user_id);
              //  alert(day);
               // alert(date);
                  $(".user_attend").text(user_id);
                  
			
				//alert(baseUrl);
				getHref=baseUrl+"show_details/"+day+"/"+user_id;
				$.ajax({
					url:getHref,
				    data:{date:date},
					}).done(function(data) {
					 console.log(data);
                     $(".user_date").text(data.sel_day);
                      $(".user_date_search").empty();
                      $("#attendance_info .punch-img_out").empty();
                      $("#attendance_info .active_in").empty();
                      $(".user_date_search").text(date);
                    
                     /*if(data.status=="absent"){
                        
                          var checkBoxes = $("#attendance_info .change_attend_status");
                                checkBoxes.prop("checked", !checkBoxes.prop("checked"));
                     }*/
                      $("#attendance_info .change_attend_status").val(data.status);
                       $("#attendance_info .user_name_view").empty();
                     
						$.each(data.attendance, function(index,attend){
						 
						     console.log(attend);
                             $("#attendance_info .user_name_view").text(attend.name);
						    $('#attendance_info #punch_in').text(attend.in);
                          
						    $("#attendance_info #punch_out").text(attend.out);
						   	if(attend.out != ''){
				
                                 $("#attendance_info .punch-hours span").text(attend.hours);
						   }
                             console.log(attend.details_type);
                            if(attend.details_type=="client"){
                                console.log("client");
                                $("#attendance_info .active_in").append("<h3 class='detail_header'>"+"<?php echo e(__('trans.client_attendance')); ?>"+"</h3>");
                                $.each(attend.details, function(index,detail){
                                     $("#attendance_info .active_in").append("<li class='detail_list item' href='"+detail.client_id+"'>"+detail.client_name+"</li>"); 
    			                    
                                });
                                
                            }else if(attend.details_type=="branch"){
                                $("#attendance_info .active_in").append("<h3 class='detail_header'>"+"<?php echo e(__('trans.branch_attendance')); ?>"+"</h3>");
                                $.each(attend.details, function(index,detail){
                                     $("#attendance_info .active_in").append("<li class='detail_list item' href='"+detail.branch_id+"'>"+detail.branch_name+"</li>"); 
    			                    
                                });
                                
                            }else{
                                 $("#attendance_info .active_in").append("<h3 class='detail_header'>"+"<?php echo e(__('trans.none detected')); ?>"+"</h3>");
                                 $("#attendance_info .active_in").append("<li class='detail_list item'>"+attend.address+"</li>");
                                
                            }
                          
			               // $("#attendance_info .active_in").text(attend.address);
						    //$("#attendance_info .lat_in").text(attend.lati);
						    //$("#attendance_info .lang_in").text(attend.longi);
							$("#attendance_info .punch-img_in span").html("<img src='"+img_url+"public/"+attend.attend_img+"' />");
                            
							
							
						});
						if(data.attendance_attach_out!=""){
						  
							$.each(data.attendance_attach_out, function(index,attendance_out){
										console.log(attendance_out);
								$("#attendance_info .active_out").text(attendance_out.address);
							//	$("#attendance_info .lat_out").text(attendance_out.lati);
							//	$("#attendance_info .lang_out").text(attendance_out.longi);
                                
								$("#attendance_info .punch-img_out").html("<img src='"+img_url+"public/"+attendance_out.attend_img+"' />");
                                
							});
						}
						$.each(data.user_shift_roll, function(index,user_shift_roll){
						    
							$("#attendance_info .break_value").text(user_shift_roll.active);
							$("#attendance_info .over_time_value").text(user_shift_roll.over_time);
						});
					/*	$.each(data.outdoor_attendance, function(index,outdoor_attendance){
								//$("#attendance_info .break_value").text(user_shift_roll.active);
							//	$("#attendance_info .over_time_value").text(user_shift_roll.over_time);
						
							
                            if(outdoor_attendance.type == 'in'){
						    		$('.res-activity-list').append('<li><p class="mb-0">Punch '+outdoor_attendance.type+' at <a class="outdoor_avatar avatar-xs" href="profile"><img alt="" src="'+ img_url+''+outdoor_attendance.avatar+'"></a></p><p class="res-activity-time"><i class="fa fa-clock-o"></i>'+outdoor_attendance.time_in+'</p></li>');
                            }else{
									$('.res-activity-list').append('<li><p class="mb-0">Punch '+outdoor_attendance.type+' at <a class="outdoor_avatar avatar-xs" href="profile"><img alt="" src="'+ img_url+''+outdoor_attendance.avatar+'"></a></p><p class="res-activity-time"><i class="fa fa-clock-o"></i>'+outdoor_attendance.time_out+'</p></li>');
							}
						});*/

					});
			
			});
            /* change attend status*/
       $("#attendance_info .change_attend_status").change(function(){
                       user_id=$(".user_attend").text();
                       user_date=$(".user_date").text();
                      user_date_search=$(".user_date_search").text();
                       status=$(this).children("option:selected").val();
                       data={user_id:user_id,user_date:user_date,status:status,user_date_search:user_date_search};
            	       getHref=baseUrl+"attendance/change_attend_status/"+user_id;
            	       $.ajax({
    					url:getHref,
                        data:data
    					
    					}).done(function(data) {
    					   
                            location.reload(true);
                        });
           
        });
       /*  $("#attendance_info .change_attend_status").click(function(){
                       user_id=$(".user_attend").text();
                       user_date=$(".user_date").text();
                      
                       status=$(".change_attend_status").val();
                       data={user_id:user_id,user_date:user_date,status:status};
            	       getHref=baseUrl+"attendance/change_attend_status/"+user_id;
            	       $.ajax({
    					url:getHref,
                        data:data
    					
    					}).done(function(data) {
    					   
                            location.reload(true);
                           });
                           
                         
         });*/
        
	$(".leave_type").change(function() {
	   
	        
        var leave_type_id = $(this).children("option:selected").val();
         var user_assigned=$(".leave_user").val();

		
		$.ajax({
				    url:"<?php echo e(route('get_available',$subdomain)); ?>",    
					data:{id:leave_type_id,user_id:user_assigned},
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					}).done(function(data) {
						console.log(data);
						$(".available_days").text(data.available_days);
				
	             });
        
	});
	$("#add_leave , #edit_leave").on('show.bs.modal', function(event) {
        var leave_type_id = $(".select_leave_type option:selected").val();
	
         var user_assigned=$(".leave_user").val();

		
		$.ajax({
				    url:"<?php echo e(route('get_available',$subdomain)); ?>",    
					data:{id:leave_type_id,user_id:user_assigned},
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					}).done(function(data) {
						console.log(data);
						$(".available_days").text(data.available_days);
				
	             });

	});
     /*add leave */
	 $("input[name='leave_from']").on( 'keyup', function() {
	
		var  date1=$("input[name='leave_from']").val();
		var  date2=$("input[name='leave_to']").val();
	
		var Difference_In_Time = date2 .getTime() - date1 .getTime();
		// To calculate the no. of days between two dates
		var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
	    console.log($("input[name='days']").val());

	 });

	$("input[name='leave_from'] , input[name='leave_to']").datetimepicker({
		format: 'YYYY-MM-DD',
	});
var days ;
	$("input[name='leave_from'] ").on("dp.change", function() {
		
		   
			var  date1=$("input[name='leave_from']").val();
			var  date2=$("input[name='leave_to']").val();
			 days = daysdifference(date1,date2);  
			// Add two dates to two variables    
			
			$("input[name='days']").val(days+1);
			if(days > $(".available_days").text()){
				/*$("#add_leave form").submit(function(e){
					e.preventDefault();
				
				});*/
				$("#add_leave .msg-text , #edit_leave .msg-text").text("number of days must be in rang");

			}else{
                   
			    $("#add_leave .save_msg, #edit_leave .save_msg").empty();
				$("#add_leave .msg-text, #edit_leave .msg-text").empty( );
			}
	});


	$("input[name='leave_to'] ").on("dp.change", function() {
	
			var  date1=$("input[name='leave_from']").val();
			var  date2=$("input[name='leave_to']").val();
			 days = daysdifference(date1,date2);  
			// Add two dates to two variables    
			$("input[name='days']").val(days+1);
			
			
			if(days > $(".available_days").text()){
	           
				/*$("#add_leave form").submit(function(e){
					e.preventDefault();
				});*/
				//$("#add_leave .save_msg").empty();
				$("#add_leave .msg-text, #edit_leave .msg-text").text("number of days must be in rang");
	

			}else{
			    $("#add_leave .save_msg, #edit_leave .save_msg").empty();
				$("#add_leave .msg-text, #edit_leave .msg-text").empty( );
			}
	});
		$("#add_leave form ,#edit_leave from").submit(function(e){
			if(days <= $(".available_days").text()){
			    $("#add_leave .save_msg , #edit_leave .save_msg").empty();
				$("#add_leave .msg-text, #edit_leave .msg-text").empty( );
				e.returnValue = true;


		    }else{
				
				e.preventDefault();
				$("#add_leave .save_msg ,  #edit_leave .save_msg").empty();
				$("#add_leave .save_msg ,  #edit_leave .save_msg").text("number of days must be in rang");
	
			}
		});
	function daysdifference(firstDate, secondDate){  
		var startDay = new Date(firstDate);  
		var endDay = new Date(secondDate);  
	 
		var millisBetween = endDay.getTime() - startDay.getTime();  
	 
		 days1 = millisBetween / (1000 * 3600 * 24); 
		
		 if (days1 >= 0) {
          
		     return Math.round(Math.abs(days1)); 
		}else{
             return "NaN";
		}

	}  

  

/*  leave edit */
	$("#edit_leave").on('show.bs.modal', function(event) {

		var button = $(event.relatedTarget) //Button that triggered the modal
	
		var getHref = button.data('href'); //get button href
		
		var id = button.attr('leave-id'); 

		update_url=baseUrl+"leaves-update/"+id;
	
		$('#edit_leave form').attr('action',update_url);
		$.ajax({
			url:getHref,
			data:{id:id},
			}).done(function(leave) {
			//$.each(data, function( index,leave){
				console.log(leave);
			//	$("input[name='user_id']").val(leave.name);
			//	$("input[name='type']").val(leave.leave_type_id);
				
				$("select[name='user_id']").val(leave.user_id);
				$("select[name='user_id']").val(leave.user_id).change();
              
				$("select[name='type']").val(leave.leave_type_id);
				$("select[name='type']").val(leave.leave_type_id).change();
				
				$("input[name='leave_from']").val(leave.leave_from);
				$("input[name='leave_to']").val(leave.leave_to);	
				$("input[name='days']").val(leave.days);
				$("input[name='leave_reson']").val(leave.leave_reson);
		
		//	});

		});
	});
	    /*leave status */

			
				
        /* leave setting */

       
            $(document).on('click', '.leave-save-btn', function() {
		
                leave_div=$('.leave-save-btn').closest(".leave-row");
				leave_name=leave_div.find('input').attr('attr_type');
				column=leave_div.find('input').attr('column');
				console.log(column);
				if(column=="earned_leave"){
				     field_value=$('input[name=earned_]:checked').val();
				}else if(column=="carry_forward_days"){
                     field_value=$('.carry_forward_days').val();
				}
				else{
				     field_value= leave_div.find('input').val();
				}
				if(leave_name=="LOP"&&column=="lop_carry_forward_days"){
                      field_value=$('.lop_carry_forward_days').val();
					  column='carry_forward_days';
					  leave_name=$('.lop_carry_forward_days').attr('attr_type');
					 
				}
				if(leave_name=="LOP"&&column=="num_days"){
                
					 
				}
				console.log(field_value);
				console.log(leave_name);
				console.log(column);
				$.ajax({
				 		url:baseUrl+"leave/leave-settings-update",
						data:{'leave_name':leave_name,'column':column,'field_value':field_value},
						success:function(data){
							if(column=="earned_leave"){
								$('input[name=earned_]:checked').val(field_value);
							}else{
								  leave_div.find('input').val(field_value);  
							}
                         
						   	leave_div.find(".leave-action .btn").prop('disabled', true);	
							leave_div.find( ".leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
							leave_div.find( ".leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
							leave_div.find( ".leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
						 
						}
				});		 


			});
    
            /* leave type status control */
          
            var annualSwitchStatus = false;
            $("#switch_annual,#switch_sick,#switch_maternity,#switch_paternity,#switch_hospitalisation,#switch_custom01").on('change', function() {
                switch_type=$(this).attr('switch_status');
                
                if ($(this).is(':checked')) {
                    //alert($(this).is(':checked'));
                    annualSwitchStatus= $(this).is(':checked');
                   
                    
                }
                else {
                  //  alert("k"+$(this).is(':checked'));
                   annualSwitchStatus= $(this).is(':checked');
                   
                }
                
                $.ajax({
      	                type:"post",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    	url:baseUrl+"leaves/leave-settings-change_status",
						data:{'switch_status':annualSwitchStatus,'switch_type':switch_type},
						success:function(data){
							location.reload(true);
						}
                });
            });
	              /* search */
         /* branch serach */
	
	
      /* arabic data table */       
$("#table_search").DataTable({
    dom:"Bflrtip",
    language:{
        url:"https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json"
    },
    buttons:[
        {
            extend: 'searchBuilder',
            config: {
                depthLimit: 2
            }
        }
    ],
});

    
    
        /* employee */
		$('#employee_name').on( 'keyup', function () {
			   
			table.columns(0).search( this.value ).draw();
		});
		$('#employee_phone').on( 'keyup', function () {
			   
			table.columns(3).search( this.value ).draw();
		} );
	      /* user shift ssearch */
	    $("#search_user_shift").click(function(){
			   var user_shift_name= $(".user_shift_name").val();
			   var department=$(".department_").val();
			   //var from=$(".from_date").val();
			   //var to_date=$(".to_date").val();
			
				
				let getHref1=baseUrl+"usershift/user_shift_search";
			  	$.ajax({
				    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post",
					url:getHref1,
					data:{user_shift_name:user_shift_name,department:department},
                    beforeSend: function() { $("#basic_data #load").show(); },
					}).done(function(data) {
                        $("#basic_data #load").hide();
	                    $("#basic_data").empty();
						$("#basic_data").append(data);
                         $('#basic_data').find('#table_search').DataTable({"scrollX": true});
                        $('#basic_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
				});

		});
		/* attendance search*/
		$("#search_attendance").click(function(){
			var employee_name= $(".employee_name").val();
			var month=$(".month").val();
			var year=$(".year").val();
			
		
			
			let getHref1=baseUrl+"attendance";/*/attendance_search*/
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{employee_name:employee_name,month:month,year:year},
                beforeSend: function() { $("#attendance_data #load").show(); },
				}).done(function(data) {
                    history.pushState('', '',"<?php echo e(url('admin/attendance')); ?>"+"?employee_name="+employee_name+"&month="+month +"&year="+year);
			

                    $("#attendance_data #load").hide();
					$("#attendance_data").empty();
					$("#attendance_data").append(data);
                    $('#attendance_data').find('#table_search').DataTable({"scrollX": true});
                    $('#attendance_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});

        /*search task */
		$('.employee_task').on( 'keyup', function () {
			   
			table.columns(1).search( this.value ).draw();
		});
         
		$('.employee').change(function(){
			   
			table.columns(2).search( this.value ).draw();
		});

		$('.status').change(function(){
			   
			table.columns(4).search( this.value ).draw();
		});

		/*var minDate, maxDate;
		
		// Custom filtering function which will search data in column four between two values
		$.fn.dataTable.ext.search.push(
			function( settings, data, dataIndex ) {
				var min = minDate.val();
				var max = maxDate.val();
				var date = new Date( data[6] );
		
				if (
					( min === null && max === null ) ||
					( min === null && date <= max ) ||
					( min <= date   && max === null ) ||
					( min <= date   && date <= max )
				) {
					return true;
				}
				return false;
			}
		);
		
		$(document).ready(function() {
			// Create date inputs
			minDate = new DateTime($('#min'), {
				format: 'MMMM Do YYYY'
			});
			maxDate = new DateTime($('#max'), {
				format: 'MMMM Do YYYY'
			});

			// Refilter the table
			$('#min, #max').on('change', function () {
				table.draw();
			});
		});*/
    /*search leaves */

		$("#search_leave").click(function(){
			var employee_name= $(".leave_serch .employee_name").val();
			var leave_type= $(".leave_serch .leave_type").val();
			var status= $(".leave_serch .status").val();
			var from= $(".leave_serch  input[name='date_from']").val();
			var to= $(".leave_serch input[name='date_to']").val();
		    var department=$(".department").val();
			var branch=$(".branch").val();
			
		
			
			let getHref1=baseUrl+"leaves";//leave_search";
			$.ajax({
				//headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{employee_name:employee_name,leave_type:leave_type,status:status,from:from,to:to,department:department,branch:branch},
                beforeSend: function() { $("#leave_data #load").show(); },
				}).done(function(data) {
                        history.pushState('', '',"<?php echo e(url('admin/leaves')); ?>"+"?employee_name="+employee_name+"&status="+status+"&from="+from +"&leave_type="+leave_type+"&to="+to+"&department="+department+"&branch="+branch);
			
                    
                    $("#leave_data #load").hide();

					$("#leave_data").empty();
					$("#leave_data").append(data);
                    $('#leave_data').find('#table_search').DataTable({"scrollX": true});
                    $('#leave_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});
		/*search task*/
		$("#search_task").click(function(){
			var employee_name= $(".task_search .employee_name").val();
          
            var date_from =$(".task_search  input[name='date_from']").val();
            var date_to =$(".task_search input[name='date_to']").val();
			var status= $(".task_search .status").val();
		    var department=$(".department").val();
			var branch=$(".branch").val();
	

		
			
			let getHref1=baseUrl+"task";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{employee_name:employee_name,date_from:date_from,date_to:date_to,status:status,department:department,branch:branch},
                beforeSend: function() { $(".task_result #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/task')); ?>"+"?employee_name="+employee_name+"&date_from="+date_from +"&status="+status+"&date_to="+date_to+"&department="+department+"&branch="+branch);
			
                    
                    $("#task_data #load").hide();
					$("#task_data").empty();
					$("#task_data").append(data);
                    $('#task_data').find('#table_search').DataTable({"scrollX": true});
                    //$('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});

		/*search outdoor*/
		$("#search_outdoor").click(function(){
			var employee_name= $("#outdoor .employee_name").val();
          
            var customer_id =$("#outdoor .customer_id").val();
			var status= $("#outdoor .status").val();
			var date= $("#outdoor input[name='date']").val();
		//	var to= $("#outdoor input[name='date_to']").val();
            var created_by= $("#outdoor select[name='created_by']").val();

		
			
			let getHref1=baseUrl+"outdoor";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by},
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/outdoor')); ?>"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    //$('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});
		/*search question visit*/
		$("#search_question").click(function(){
			var visit_type= $("#visit_que .visit_type").val();
			var type= $("#visit_que .type").val();
			
             
		
			
			let getHref1=baseUrl+"visit_question/visit_question_search";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"post",
				url:getHref1,
				data:{visit_type:visit_type,type:type},
                beforeSend: function() { $(".visit_question_data #load").show(); },
				}).done(function(data) {


                    $(".visit_question_data #load").hide();
					$(".visit_question_data").empty();
					$(".visit_question_data").append(data);
                    $('.visit_question_data').find('#table_search').DataTable({"scrollX": true});
                    $('.visit_question_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});


	/* search visit visit_report_details

		$("#search_visit_report").click(function(){
			var user_id= $("#visit_report .user_id").val();
			var from= $("#visit_report .from").val();
			var to= $("#visit_report .to").val();
			
            var visit_type= $("#visit_report .visit_types").val();
		
			
			let getHref1=baseUrl+"visit_report/visit_report_search";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"post",
				url:getHref1,
				data:{user_id:user_id,from:from,to:to,visit_type:visit_type},
				}).done(function(data) {

					$(".visit_report_data").empty();
					$(".visit_report_data").append(data);
			});

		});
*/
 
 
 
 	/* search visit visit_report_details*/

    	$("#search_visit_report").click(function(e){
    	     e.preventDefault();
    	  
  			var user_id=$(".employee_name").val();
            var customer_id=$(".client_name_branch").val();
            var visit_type=$(".visit_types").val();
            var from=$(".from").val();
			var to=$(".to").val();
  	        var department=$(".department").val();
			var branch=$(".branch").val();
		    $('#visit_printlink').attr("href","<?php echo e(url('admin/visitPrint/visit')); ?>"+"?user_id="+user_id+"&customer_id="+customer_id+"&visit_type="+visit_type+"&to="+to+"&from="+from+"&department="+department+"&branch="+branch);
		    var visit_type= $("#visit_report .visit_types").val();
		
			
			let getHref1=baseUrl+"visitReport";
			$.ajax({
			//	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{user_id:user_id,from:from,to:to,visit_type:visit_type,department:department,branch:branch,customer_id:customer_id},
                beforeSend: function() { $(".visit_report_data #load").show(); },
				}).done(function(data) {
				     history.pushState('', '',"<?php echo e(url('admin/visitReport')); ?>"+"?user_id="+user_id+"&from="+from+"&to="+to+"&visit_type="+visit_type+"&department="+department+"&branch="+branch+"&customer_id="+customer_id);
                    $(".visit_report_data #load").show();
					$(".visit_report_data").empty();
					$(".visit_report_data").append(data);
                    $('.visit_report_data').find('#table_search').DataTable({"scrollX": true});
                    $('.visit_report_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
        });
        
        


	/*  custom edit */
			$("#viewannual_custom_policy").on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var id = button.attr('custom_id'); 
				var type= button.attr('custom_type'); 
				
				 
			
				
				view_url=baseUrl+"leave/view-custom";
				
				$.ajax({
					url:view_url,
					data:{id:id,type:type},
					}).done(function(data) {
					console.log(data);
					 $('#annual_employee_policy').append('<table><tr>')
					$.each(data,function(index,user_detail){
						 $('#annual_employee_policy').append('<td> <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a  <a href="#">'+user_detail['username']+'</a></td>');
					    
						
					});
	
				});	 $('#annual_employee_policy').append('</tr></table>');
			});




		$(document).on('change', '.nearest_branch', function() {
	       
			if ($("input[name='nearest_branch']:checked").val() == 1) {
		
				$("input[name='distance']").prop('disabled', false);
				
			}
			else {
			
				$("input[name='distance']").prop('disabled', true);	
	
			}
	    });

/*job */
		/*   job edit */
		$("#edit_job").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('job-id'); 
		   
		
			
			
			update_url=baseUrl+"job-update/"+id;
			$('#edit_job form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,job){
				  console.log(job);
					$( "input[name*='title']" ).val(job.title );
           
				});

			});
		});
	
		/*leave_status*/
		    let leave_status; 
			let leave_id;
			$("#stutas_leave").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
			    leave_status= button.attr('status');
			
                leave_id= button.attr('leave-id');
              
			
			});
			$(".leave_status_continue-btn").click(function(){
                 	leave_answer=$("#stutas_leave textarea[name='answer']").val();
                      
				$.ajax({
					url:"<?php echo e(route('change-status',$subdomain)); ?>",    
					data:{status:leave_status,leave_id:leave_id,answer:leave_answer},
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
					   location.reload(true);
		
				});

			});
 
        /*client */
		/*  client edit */
		$("#edit_client").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('client-id'); 
		   
		
			
			
			update_url=baseUrl+"client-update/"+id;
			$('#edit_client form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id}
				}).done(function(data) {
				$.each(data, function( index,client){
				  console.log(client);
				    $( "input[name*='name']" ).val(client.name );
					$( "input[name*='phone']" ).val(client.phone );
					
					$( "select[name*='client_type_id']" ).val(client.client_type_id );
					$( "select[name*='client_type_id']" ).val(client.client_type_id ).change();
					
					$( "input[name*='address']" ).val(client.address );
					$( "input[name*='add_lat']" ).val(client.lati);
					$( "input[name*='add_lang']" ).val(client.longi);
					$( "input[name*='email']" ).val(client.email );
					$( "input[name*='contact_person']" ).val(client.contact_person );
					$( "input[name*='contact_phone']" ).val(client.contact_phone);
					$( "input[name*='start_time']" ).val(client.start_time);
					$( "input[name*='end_time']" ).val(client.end_time );
					
                    $( "select[name*='branch']" ).val(client.branch_id);
                    $( "select[name*='branch']" ).val(client.branch_id).change();
                    
                    $("input[name='target_vists']").val(client.target);
                    $("select[name*='branch']").prop('checked', true);
					$( "select[name*='specializations_id']" ).val(client.specialization_id);
					$( "select[name*='specializations_id']" ).val(client.specialization_id).change();
                    i_client=1;
                             console.log(client.appointments);
                    if(client.appointments!=""||client.appointments!=[]){
                        $.each(JSON.parse(client.appointments), function(index,appoint){
                            console.log(appoint);
                            var option_all="";
                            if(appoint.day=="all"){
                                $("#edit_client .client_sch .day_0").val(appoint.day);
                                 $("#edit_client .client_sch .str_0").val(appoint.start_time);
                                  $("#edit_client .client_sch .end_0").val(appoint.end_time);
                                //option_all='<option value="all">-- all --</option>';
                            }else{
                                                                             
                               $(".client_appoints").append('<div  class="client_sch appoint_'+i_client+' row" id="'+i_client+'" ><div class="col-sm-4"> <label class="col-form-label"><?php echo e(__("trans.day")); ?> <span class="text-danger" >*</span></label><select class="select day_'+i_client+'" name="day[]" value="'+appoint.day+'"><option value="6"><?php echo e(__("trans.saturday")); ?></option><option value="0"><?php echo e(__("trans.sunday")); ?></option><option value="1"><?php echo e(__("trans.monday")); ?></option><option value="2"><?php echo e(__("trans.thursday")); ?></option><option value="3"><?php echo e(__("trans.wednsday")); ?></option><option value="4"><?php echo e(__("trans.tuesday")); ?></option><option value="5"><?php echo e(__("trans.friday")); ?></option></select></div><div class="col-sm-3"><label><?php echo e(__("trans.From")); ?> <span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="start_time[]" value="'+appoint.start_time+'"/></div></div><div class="col-sm-3"><label><?php echo e(__("trans.To")); ?><span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="end_time[]" value="'+appoint.end_time+'"/></div></div><div class="col-sm-2" onclick="delete_appoint('+i_client+');"><i class="fa fa-minus"></i></div></div>');
       			               $("#edit_client .client_sch .day_"+i_client).val(appoint.day);
                                   ++ i_client;  
                            }
                      
                        });
                    }
				});

			});
		});
	
		let clientdelete_url;
		let clientdel_id;
		$("#delete_client").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var id= button.attr('delete-id');
				clientdel_id=id;
				
			
				
				clientdelete_url=baseUrl+"client-delete";  
			
		});
		$("#delete_client .continue-btn").click(function(){
         
			$.ajax({
					url: clientdelete_url,    
					data:{id:clientdel_id},
				    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

		});

		/*edit client type*/
		/*   client_type edit */
		$("#edit_client_type").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('client_type-id'); 
		   
		
			
			
			update_url=baseUrl+"client_type-update/"+id;
			$('#edit_client_type form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,client_type){
				  console.log(client_type);
					$( "input[name*='name']" ).val(client_type.name );
           
				});

			});
		});
	
	/* delete client type */
		let client_tydelete_url;
		let client_tydel_id;
		$("#delete_client_type").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	              
				var id= button.attr('delete-id');
				client_tydel_id=id;
				
			
				
				client_tydelete_url=baseUrl+"client_type-delete";
			
		});
		$("#delete_client_type .continue-btn").click(function(){
         
			$.ajax({
					url: client_tydelete_url,    
					data:{id:client_tydel_id},
				    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				     
                       location.reload(true);
				});

		});


		/* report dialy */
		$('.DialyReport').click(function(){
			$.ajax({
					url: "<?php echo e(route('dialy-present',$subdomain)); ?>",    
					data:{'type':$(this).attr('type')},
				    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				        $(".dialy_result").empty();
						$("#basic_").append(data);
                       
				});
           

		});
        
$( document ).ready(function() {
				    let searchParams = new URLSearchParams(window.location.search);
                   if( searchParams.has('branch')==true){
                        branch = searchParams.get('branch');
                         $(".branch select").val(branch);
                   }
                   
                   });
		/* month report search search*/ 
		$("#search_month").click(function(){
			var department=$(".department").val();
            var branch=$(".branch").val();
            var user=$(".employee_name").val();
			var date_to=$("input[name='date_to']").val();
  	        var date_from=$("input[name='date_from']").val();
		    $('#month_printlink').attr("href","<?php echo e(url('admin/monthlyPrint/monthly')); ?>"+"?department="+department+"&branch="+branch+"&date_to="+date_to+"&date_from="+date_from+"&user="+user);
		    history.pushState('', '',"<?php echo e(url('admin/month-report')); ?>"+"?department="+department+"&branch="+branch+"&date_to="+date_to+"&date_from="+date_from+"&user="+user);
			
			
			let getHref1=baseUrl+"month-report";
			$.ajax({
				/*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
				type:"get",
				url:getHref1,
				data:{department:department,branch:branch,date_to:date_to,date_from:date_from,date_to:date_to,user:user},
                beforeSend: function() { $("#month_body #load").show(); },
				}).done(function(data) {

                    $("#month_body #load").show(); 
					$(".month_result").empty();
					$("#month_body").append(data);
                    $(".branch select").val(branch);
                    $(".department select").val(department);
                    $("input[name='date_to']").val(date_to);    
                    $("input[name='date_from']").val(date_from); 
                   $(".employee_detail").each(function() {
                       
                       var $this = $(this);       
                       var _href = $this.attr("href"); 
                       $this.attr("href",_href+ '?date_from='+date_from+'&date_to='+date_to);
                    }); 
                    $('#month_body').find('#table_search').DataTable({"scrollX": true});
                    $('#month_body').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
   
               });
  
		});
        /*  dialy report search*/
        
        $("#search_daily").click(function(){
			var department=$(".department").val();
            var branch=$(".branch").val();
            var user=$(".employee_name").val();
			var date_to=$("input[name='date_to']").val();
  	        var date_from=$("input[name='date_from']").val();
            var type=$("input[name='type_daily']").val();
		    $('#daily_printlink').attr("href","<?php echo e(url('admin/dialyPrint/present')); ?>"+"?department="+department+"&branch="+branch+"&date_to="+date_to+"&date_from="+date_from+"&user="+user);
		
			
			let getHref1=baseUrl+"report-dialy";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{department:department,branch:branch,date_to:date_to,date_from:date_from,date_to:date_to,user:user,type:type},
                  beforeSend: function() { $("#basic_ #load").show(); },
				}).done(function(data) {
                    //console.log(data);

                    $("#basic_ #load").show(); 
					$(".dialy_result").empty();
					$("#basic_").append(data);
                    $('#basic_').find('#table_search').DataTable({"scrollX": true});
                   $('#basic_').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

		});
        
        
       	$("#search_userReport").click(function(){
	    
            var user=$(".employee_name").val();
			var date_to=$("input[name='date_to']").val();
  	        var date_from=$("input[name='date_from']").val();
            if(user==null){
                $(".select_userforreport").addClass('alert alert-danger');
                $(".alert_msg").text("<?php echo e(__('trans.select user')); ?>");
            }else{
                $(".select_userforreport").removeClass('alert alert-danger');
                $(".alert_msg").text("");
		    $('#userReport_printlink').attr("href","<?php echo e(url('admin/userReportPrint/userReport/"+user+"')); ?>"+"?date_to="+date_to+"&date_from="+date_from+"&id="+user);
		
			
			let getHref1=baseUrl+"userReport/"+user;
			$.ajax({
				/*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
				type:"get",
				url:getHref1,
				data:{date_to:date_to,date_from:date_from,date_to:date_to,user:user},
				}).done(function(data) {

					$(".userReport_result").empty();
					$("#userReport_").append(data);
			});
            }

		});

//for evalaution employess
$("#search_available").click(function()
     {
        
      
          
           //   return;
          
        
            var employee_name= $(".avaliable_search .employee_name").val();
            var client=$(".avaliable_search .client").val();
            var branch=$(".avaliable_search .branch").val();
            var type=$(".avaliable_search .type").val();
          //alert(type);
             
            
         
 		   // let getref=baseUrl+"evaluation_search";
             let getref=baseUrl+"attendance/employee_available/"+type+"/";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"get",
			    url:getref,
               	data:{employee_name:employee_name,client:client,branch:branch,type:type},
				  
       
				   beforeSend: function() { $(".available_data #load").show(); },
				}).done(function(data)
                {
                  //console.log(data);
                 // return;
                    history.pushState('', '',"<?php echo e(url('admin/attendance/employee_available')); ?>"+"/"+type+"?employee_name="+employee_name+"&client="+client +"&branch="+branch);
			
                    $(".available_data #load").hide();
					$(".available_data").empty();
					$(".available_data").append(data);
                  // $('#search_data').find('.datatable').DataTable({"scrollX": true});
                  // $('#search_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
               
		    	});

          
          
          
          
});
   $(document).ready(function(){
   // company_img upload
    $(".but_upload").change(function(){
    
        var fd = new FormData();
        
                  
        var files = $('#file')[0].files;
        console.log(files);
        // Check file selected or not
        if(files.length > 0 ){
            
           fd.append('file',files[0]);

           $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: '<?php echo e(route("images.store",$subdomain)); ?>',
              type: 'post',
              data:fd,  
              contentType: false,
              processData: false,
              success: function(response){
                console.log(response);
                 if(response != 0){
                    
                    $("#img").attr("src",img_url+"/public/"+response); 
                    $("#company_logo").val(response);
                    $(".preview img").show(); // Display image element
                 }else{
                    alert('file not uploaded');
                 }
              },
           });
        }else{
           alert("Please select a file.");
        }
    });
    // company img delete
   $("#edit_company .delete_img").click(function(){
            del_img_id=$(this).attr('company_id');
			$.ajax({
					url:'<?php echo e(route("company-img-delete",$subdomain)); ?>',    
					data:{id:del_img_id},
					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:"post"
					}).done(function(data) {
				    // location.reload(true);
	
				});

	});
});

     
      /*    role edit */
		$("#edit_role").on('show.bs.modal', function(event) {

			var button = $(event.relatedTarget) //Button that triggered the modal
		
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('role-id'); 
 
			update_url=baseUrl+"role-update/"+id;
			$('#edit_role form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,role){
				console.log(role);
					$("#edit_role form input[name='name']").val(role.name);
				//	$("#edit_role form input[name='permission']").val();
				});
               $.each(data, function( index,permissions){
				
					$("#edit_role form input[name='permission']").val(permissions.name);
				//	$("#edit_role form input[name='permission']").val();
				});

			});
		});
        

		$("#add_role button,#edit_role button").click(function(e){

            e.preventDefault();

			var url="";
		    if($(this).attr('type')=="add"){
                url=$('#add_role form').attr('action');
                var name= $("#add_role form input[name='name']").val();	
			    var permission = new Array();
                    $("#check_permission input:checked").each(function() {
                    permission.push($(this).attr('value'));
                });
			    data= {name:name,permission:permission};
             
             
             }
			if($(this).attr('type')=="edit"){
               url=$('#edit_role form').attr('action');
               var name= $("#edit_role form input[name='name']").val();	
              // var permission= $("#edit_role form input[name='permission[]']").val();
			   var permission = new Array();
                $("#check_permission input:checked").each(function() {
                   permission.push($(this).attr('value'));
                });
               // alert(permission);
  	           data= {name:name,permission:permission};
             }
		
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
                   if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});      
          /*    role edit */
		$("#edit_role").on('show.bs.modal', function(event) {
 
			var button = $(event.relatedTarget) //Button that triggered the modal
		
			var getHref = button.data('href'); //get button href
		
			var id = button.attr('role-id'); 

			update_url=baseUrl+"role-update/"+id;
			$('#edit_role form').attr('action',update_url);
            
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {

                    $("#edit_role form input[name='name']").val(data.role.name);	
    
                    $.each(data.permissions, function(index,permission){
               
                         $('#edit_role form input[name="permission['+permission.permission_id+']"]').attr('checked','checked');
                       
					
				});
  

			});
		});
        
  /* end roll */
   /**
    * stART permission */
    
		$("#add_permission button,#edit_permission button").click(function(e){

            e.preventDefault();
           


			var url="";
		    if($(this).attr('type')==="add"){
                url=$('#add_permission form').attr('action');
                var table_name= $("form input[name='table_name']").val();	
    			var key= $("form input[name='key']").val();
    			
			    data= {table_name:table_name,key:key};
             
             
             }
			if($(this).attr('type')==="edit"){
               url=$('#edit_permission form').attr('action');
               var table_name= $("form input[name='table_name']").val();	
               //	var key= $("form input[name='key']").val();
			
				data= {table_name:table_name,key:key};
             }
		
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function(data) {
                   
                   if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                     
                        printErrorMsg(data.error);
                    }
                }
            });

		});
      
$(".permission-group").click(function(){
    
    var key=$(this).attr("id");
  
  
   $( "."+key ).prop('checked',true);
   $(this).prop('checked',false);
    /* if($(this).$(".the-permission").attr('key')==key)  {
          alert(key);
        $(".the-permission").attr('key',key).prop('checked', true);
     }*/
    
});
        /* END permission*/

	   var interval =30000;  
		function doAjax() {
			$.ajax({
			        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type: 'POST',
					url: "<?php echo e(route('get-notification',$subdomain)); ?>",
					success: function (data) {
					  ///  $('#ajax_notfy').empty(); 
    					$('.notfy').empty();  
    					$('.notfy').append(data);   
					},
					complete: function (data) {
							// Schedule the next
							setTimeout(doAjax, interval);
					}
			});
		}
	
        doAjax();
/* abdelkawy scripts */
     $(document).ready(function(){
        
		$('.modal .close').click(function(){
		   $('.form-control').val('');
			$(".alert").hide();
		 });
		 
		$('.add-btn').click(function(e){
		 e.preventDefault();
		  $('.form-control').val('');
			$(".alert").hide();
		});
		
		 $('.dropdown-item').click(function(e){
		 e.preventDefault();
		  $(".alert").hide();
		});
		

		
$('.dropdown-item').css( 'cursor', 'pointer' );
//for convert between gridview and listview
 $('.grid-view').click(function(){
	$(".table-responsive").hide();
	  $(".staff-grid-row").show();
	
	  $(".grid-view").addClass("active");
	  $(".list-view").removeClass("active");
 });  
 
 $('.list-view').click(function(){
	$(".table-responsive").show();
	  $(".staff-grid-row").hide();
	
	  $(".list-view").addClass("active");
	  $(".grid-view").removeClass("active");
	 
	  
 }) ;     	
    }) ;    
</script>
 <script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.visit_report_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_visit_report').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
      /*  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
              
        });*/
        	var user_id=$(".employee_name").val();
            var customer_id=$(".client_name_branch").val();
            var visit_type=$(".visit_types").val();
            var from=$(".from").val();
			var to=$(".to").val();
  	        var department=$(".department").val();
			var branch=$(".branch").val();
       	    data={user_id:user_id,from:from,to:to,visit_type:visit_type,department:department,branch:branch,customer_id:customer_id},
            $.ajax({
    				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    				type:"get",
    			    url: '?page=' + page,
    			 	data:data,
                    beforeSend: function() { $(".visit_report_data #load").show(); },
    				}).done(function(data) {
    				     history.pushState('', '',"<?php echo e(url('admin/visitReport')); ?>"+"?user_id="+user_id+"&from="+from+"&to="+to+"&visit_type="+visit_type+"&department="+department+"&branch="+branch+"&customer_id="+customer_id+"&page="+page);
                        $(".visit_report_data #load").show();
    					$(".visit_report_data").empty();
    					$(".visit_report_data").append(data);
                        $('.visit_report_data').find('#table_search').DataTable({"scrollX": true});
                        $('.visit_report_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
    			});
    }
    
    //Evaluation search
  $("#evaluation_search").click(function(){
   
	
   var department=$(".department").val();
 //  console.log(department);
  // return;
   var branch=$(".branch").val();
  // console.log(branch);
   var user=$(".employee_name").val();
  // console.log(user);
  // return;
 //	var date_to=$("input[name='date_to']").val();
// var date_from=$("input[name='date_from']").val();
 let date_from=new Date($("input[name='date_from']").val());
 let from_month=((date_from.getMonth()+1) <= 9 ? '0': '') + (date_from.getMonth()+1) ;
 
 let from_year=date_from.getFullYear();

 let date_to=new Date($("input[name='date_to']").val());
  let to_month=((date_to.getMonth()+1) <= 9 ? '0': '') + (date_to.getMonth()+1) ;
 //let to_month="0"+(date_to.getMonth()+1);

 let to_year=date_to.getFullYear();

	
	$('#evaluation_printlink').attr("href","<?php echo e(url('admin/evaluationprint/evalaution')); ?>"+"?department="+department+"&branch="+branch+"&user="+user+"&from_month="+from_month+"&from_year="+from_year+"&to_month="+to_month+"&to_year="+to_year);
	
   let getHref1=baseUrl+"Evaluation_Report";
   $.ajax({
	   /*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
	   type:"get",
	   url:getHref1,
	   data:{department:department,branch:branch,user:user,from_month:from_month,from_year:from_year,to_month:to_month,to_year:to_year},
	   
	   beforeSend: function() { $("#evaluation_body #load").show(); },
	   }).done(function(data) {
	      // console.log(data);
      // return;
		  //alert('fff');
		 // console.log(data);
         // return;
		   $("#evaluation_body #load").hide(); 
		   $(".evaluation_result").empty();
		   $(".evaluation_result").append(data);                 
		   
		  $('#evaluation_body').find('.datatable').DataTable({"scrollX": true});
		  $('#evaluation_body').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"}); 
	  });

});



//for evalaution employess
$("#evalua_emp #search_empeval").click(function()
     {
        
      
          //alert('fsffssfsf');
           //   return;
          
        
            var employee_name= $("#evalua_emp .employee_name").val();
            var department=$("#evalua_emp .department").val();
            var branch=$("#evalua_emp .branch").val();
            var month=$("#evalua_emp .month").val();
            var year=$('#evalua_emp .year').val();
          
             
            
         
 		   // let getref=baseUrl+"evaluation_search";
             let getref=baseUrl+"evaluation_employes";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"get",
			    url:getref,
               	data:{employee_name:employee_name,department:department,branch:branch,month:month,year:year},
				  
       
				   beforeSend: function() { $("#search_data #load").show(); },
				}).done(function(data)
                {
                  //console.log(data);
                 // return;
                    history.pushState('', '',"<?php echo e(url('admin/evaluation_employes')); ?>"+"?employee_name="+employee_name+"&department="+department +"&branch="+branch+"&month="+month+"&year="+year);
			
                    $("#search_data #load").hide();
					$("#search_data").empty();
					$("#search_data").append(data);
                  // $('#search_data').find('.datatable').DataTable({"scrollX": true});
                  // $('#search_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
               
		    	});

          
          
          
          
       });

	   $("#employes_evaluation").on('input', '.emp_degree', function () 
     {
            var calculated_total_sum = 0;
       $("#employes_evaluation .emp_degree").each(function () {
         
           var get_textbox_value = $(this).val();
         
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
           // console.log(calculated_total_sum);
            
             $('.emp_total_degree').val(calculated_total_sum); 
              
      
          });  

   	$("#employes_evaluation").on('show.bs.modal', function(event) 
    {
		
	      var button = $(event.relatedTarget) //Button that triggered the modal
	         var user_id = button.attr('evaluation-user'); 
            // console.log(user_id);
            // return;
             var month = button.attr('evaluation-month');
             var year = button.attr('evaluation-year');
			 //$("#te").text(month);
         // $("#employes_evaluation #monthlabel").text(month);
             // console.log(month);
             
			 var gethref=baseUrl+"getemployejob_id/"+user_id;
			 	$.ajax
            ({
			     url:gethref
              				
			}).done(function(data) {
			       
                  
                   if(data)
                     {
                   
                        $('#eva_element').empty();
                        $('#eva_element').append(data);
                        $("#eva_element  input[name='month']").val(month);
						$("#eva_element  #eval_month").text(month);
						$("#eva_element  #eval_year").text(year);
						
                        $("#eva_element  input[name='year']").val(year);	
                        // $("#evaluation_emptable").css('display','block');
                     }
                    
                     
                     });  
                             
                             
});

 $("#edit_evaluationemp").on('input', '.degree', function () 
     {
            var calculated_total_sum = 0;
       $("#edit_evaluationemp .degree").each(function () {
         
           var get_textbox_value = $(this).val();
         
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
           // console.log(calculated_total_sum);
            
             $('.total_sum_value').val(calculated_total_sum); 
              
      
          });  

$("#edit_evaluationemp").on('show.bs.modal', function(event) 
    {
            
				var button = $(event.relatedTarget) //Button that triggered the modal
		     
		        var	getHref = button.data('href'); //get button href
				
				var id = button.attr('empevalu-id'); 

			 	update_url=baseUrl+"update_empevaluation/"+id;
			    $('#edit_evaluationemp form').attr('action',update_url);
				$.ajax({
					url:getHref,
                   // data:{id:id},
				
					}).done(function(data) {
			       //   console.log(data);
                      
                     $("#edit_employeevaluation").empty();
                     $("#edit_employeevaluation").append(data);
                    
        																																																																										
                         
                             
                             
     });
                             
                             
});

//for evalaution employess
      
      /*  $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            $('#search_outdoor').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var url = $(this).attr('href');
           alert(url);
            window.history.pushState("", "", url);
            loadOutdoors(url);
        });
        function loadOutdoors(url){
            	$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:url,
				data:{employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by},
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/outdoor')); ?>"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    $('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

        }*/
</script>		<?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/layout/partials/footer-scripts.blade.php ENDPATH**/ ?>