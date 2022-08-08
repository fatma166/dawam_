       <div id="track_data">
          <?php if(($name)!="")?>  <div><h3 class='btn btn-success btn-block'><?php if(isset($name)) echo  $name; ?><span><?php if(isset($from)) echo  $from; ?></span></h3></div>
            <?php //print_r($tracks);?>
            <div id="mapCanvas"></div>
        </div>

         @section('script')
        
             <script Content-Type="text/html" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMtllOMzchTUwJ_FCi1SstrTWrD5yhO3w"></script>
              
       <script>
      
       <?php   //if($type!="ajax"){?>

 $(document).ready(function(){

         <?php  if(isset($name)&&!empty($name)) { ?>
               // Load initialize function
           initMap();
         <?php } ?>
    });
    
     
        <?php // }?> 
        </script>
        <script>
  			   
            /*search track*/
    		$("#search_track").click(function(){
    	
    			var employee_name= $("#track .employee_name").val();
              	 
             
    			var date= $("#track input[name='date']").val();
                if(date=="")date='<?php Carbon\Carbon::now()->format('Y-m-d');?>'
    
    		  
    			
    			let getHref1=baseUrl+"track";
                window.location.href = getHref1+"?employee_name="+employee_name+"&date="+date;
                history.pushState('', '',"{{url('admin/track')}}"+"?employee_name="+employee_name+"&date="+date)
    		/*	$.ajax({
    				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    				type:"get",
    				url:getHref1,
    				data:{employee_name:employee_name,date:date},
                    beforeSend: function() { $("#track_data #load").show(); },
    				}).done(function(data) {
                             console.log(data.name);
                          
                            $("#track_data #load").hide();
        					$("#track_data").empty();
            	           
        					$("#track_data").append(data);
                           
                           
                        initMap();
                          
                            //$('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
    			});*/
    
    		});
          
        function initMap() {
          // alert("jkjk");
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {mapTypeId: 'roadmap'};
                    
        // Display a map on the web page
        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
        map.setTilt(50);
            
        // Multiple markers location, latitude, and longitude
        var markers = [
            <?php if(!empty($tracks)) {if(Count($tracks) > 0){
                 foreach($tracks as  $row){
                    echo '["'.$row['name'].$row['date'].'", '.$row['lati'].', '.$row['longi'].'],';
                }
            }}
            ?>
        ];
                            
        // Info window content
        var infoWindowContent = [
            <?php  if(!empty($tracks)) {if(Count($tracks) > 0){
                $i=0;
                foreach($tracks as  $row){ ?>
                    ['<div class="info_content">' +
                  
                    '<h3><?php echo $row['date']; ?></h3>' +
                    '<p><?php echo $i; ?></p>' + '</div>'],
            <?php $i++;}
            }}
            ?>
        ];
            
        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        
        // Place each marker on the map  
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });
            
            // Add info window to marker    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
    
            // Center the map to fit all markers on the screen
            map.fitBounds(bounds);
        }
    
        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
        
    }
         </script>
         @endsection