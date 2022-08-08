	<script>

         //map

		function initMap() {

       

	 myLatlng ={lat:30.550334,lng:31.0106341};
            
        // get users lat/long
        //var lat ,lng;
        var getPosition = {
          enableHighAccuracy: false,
          timeout: 9000,
          maximumAge: 0
        };
        
        function success(gotPosition) {
           lat = gotPosition.coords.latitude;
           lng = gotPosition.coords.longitude;
        
           myLatlng={lat:lat,lng:lng};
          console.log(myLatlng);
        
        };
        
        function error(err) {
          console.warn(`ERROR(${err.code}): ${err.message}`);
          
        };
        
        navigator.geolocation.getCurrentPosition(success, error, getPosition);
      
		const map = new google.maps.Map(document.getElementById("map"), {

			zoom: 8,

			center: myLatlng,
      
            mapTypeId: google.maps.MapTypeId.ROADMAP
           	

		});


	      

  

	   const map_edit = new google.maps.Map(document.getElementById("map_edit"), {

			zoom: 8,

			center: myLatlng,
    
            mapTypeId: google.maps.MapTypeId.ROADMAP


		});

        			

		// Create the initial InfoWindow.

		let infoWindow = new google.maps.InfoWindow({

			content: "<?php echo e(__('trans.Click the map to get Lat/Lng!')); ?>",

			position: myLatlng,

		});



		/*start add*/

		infoWindow.open(map);

		// Configure the click listener.

		map.addListener("click", (mapsMouseEvent) => {

		

	

			// Create a new InfoWindow.

			infoWindow = new google.maps.InfoWindow({

			position: mapsMouseEvent.latLng,

			});

			

			let coord=(mapsMouseEvent.latLng);

			lat=coord.lat();

		

			lang=coord.lng();

			$(".add_lat").val(lat);

			$(".add_lang").val(lang);

			infoWindow.setContent(

			

			JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)

			);

			infoWindow.open(map);

			// Close the current InfoWindow.

			infoWindow.close();

		     });

			infoWindow.open(map_edit);

			// Configure the click listener.

			map_edit.addListener("click", (mapsMouseEvent) => {

			

				// Close the current InfoWindow.

				infoWindow.close();

				// Create a new InfoWindow.

				infoWindow = new google.maps.InfoWindow({

				position: mapsMouseEvent.latLng,

				});

			//	console.log(mapsMouseEvent.latLng);

				let coord_edit=(mapsMouseEvent.latLng);

				lat=coord_edit.lat();

				

				lang=coord_edit.lng();

				$(".edit_lat").val(lat);

				$(".edit_lang").val(lang);

				infoWindow.setContent(

				

				JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)

				);

				infoWindow.open(map_edit);

			});

		/* end edit */

		   new google.maps.Marker({
				position: myLatlng,
				map: map,
            });
            new google.maps.Marker({
    			position: myLatlng,
    			map: map_edit,
    		});

		}   

		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvxpFZUGuFYJCN2CHblBtdcNXJK7tiyeo&callback=initMap&language=ar&region=EG" async></script>



<?php /**PATH /home/dawam/public_html/manger/resources/views////layout/partials/map_script.blade.php ENDPATH**/ ?>