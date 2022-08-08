@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-box">
                            <div class="welcome-img">
                                <img alt="" src="img/profiles/avatar-02.jpg">
                            </div>
                            <div class="welcome-det">
                                <h3>{{$employee['name']}}</h3>
                                <p>{{ Carbon\Carbon::parse($employee['join_date'])->format('l jS \of F Y h:i:s A')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <section class="dash-section">
                            <div class="dash-sec-title"><h3>{{__('trans.outdoors')}}  <span style="float: left;">{{$counts['outdoors_count']}}</span></h3></div>
                            <div class="dash-sec-content">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">{{__('trans.clients_outdoors')}}</h3>
											<div id="bar-charts"></div>
										</div>
									</div>

                            </div>
                        </section>

                        <section class="dash-section">
                            <h1 class="dash-sec-title">{{__('trans.track')}}</h1>
                            
                            <div class="dash-sec-content">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">{{__('trans.employee_name')}}</h3>
										    <div id="mapCanvas"></div>
										</div>
									</div>
                            </div>
                        </section>

                       
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="dash-sidebar">
                            <section>
                                <h5 class="dash-title">{{__('trans.attendance')}}/{{__('trans.tasks')}}</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="time-list">
                                            <div class="dash-stats-list">
                                                <h4>{{$counts['tasks_count']}}</h4>
                                                <p>{{__('trans.Totaltasks')}}</p>
                                            </div>
                                            <div class="dash-stats-list">
                                                <h4>{{$counts['attend_count']}}</h4>
                                                <p>{{__('trans.Totalattend')}}</p>
                                            </div>
                                        </div>
                                        <div class="request-btn">
                                            <div class="dash-stats-list">
                                                <h4></h4>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <h5 class="dash-title">{{__('trans.leave')}}</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="time-list">
                                            <div class="dash-stats-list">
                                                <h4>{{$counts['leaves_count']}}</h4>
                                                <p>{{__('trans.Leave Taken')}}</p>
                                            </div>
                                            <div class="dash-stats-list">
                                                <h4>{{$counts['leavestype_count']}}</h4>
                                                <p>{{__('trans.Remaining')}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <section>
                                <h5 class="dash-title">{{__('trans.evaluation')}}</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="time-list">
                                        @if(isset($evaluation)&& !empty($evaluation))
                                         @foreach($evaluation as $eval)
                                            <div class="dash-stats-list">
                                                <h4>@if(isset($eval['title'])){{$eval['degree']}}@endif</h4>
                                                <h4>@if(isset($eval['actual'])){{$eval['actual']}}@endif</h4>
                                                
                                                <p>@if(isset($eval['title'])){{$eval['title']}}@endif</p>
                                            </div>
                                         @endforeach
                                         @endif 
                                        </div>

                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /Page Content -->

</div>
        <!-- /Page Wrapper -->
        <style>#mapCanvas {
    width: 100%;
    height: 500px;
}</style>
@endsection
@section('script')
		<script src="{{asset('plugins/morris/morris.min.js')}}"></script>

		<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

		<script>
        getUrl=window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    bar_chart_url=baseUrl+"/admin/bar-chart";  
	// Bar Chart
	    $.ajax({

		url:bar_chart_url,
        data:{id:'<?php echo $employee_id;?>'},
		}).done(function(data1) {

            //data_line_chart=data;

			console.log(data1);
			
             Morris.Bar({
        		element: 'bar-charts',
        		data:data1,
        		xkey: 'client',
        		ykeys: ['outdoor_count'],
        		labels: ['outdoors'],
        		lineColors: ['#ff9b44'],
        		lineWidth: '3px',
	         	barColors: ['#ff9b44','#fc6075'],
        		resize: false,
        		redraw: true,
                parseTime: false
        	});
      });</script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMtllOMzchTUwJ_FCi1SstrTWrD5yhO3w"></script>
        <script>	
 function initMap() {
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
                    echo '["'.$row['date'].'", '.$row['lati'].', '.$row['longi'].'],';
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
            this.setZoom(6);
            google.maps.event.removeListener(boundsListener);
        });
        
    }
     $(document).ready(function(){
    	
        
               // Load initialize function
           initMap();
         
    });
    </script>
@endsection