<script>

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  function initAutocomplete() {

	$(window).keydown(function(event){
		
    if(event.keyCode == 13) {
		console.log(event);
      event.preventDefault();
      return false;
    }
  });




	$(".modal").on('show.bs.modal', function (event) {
      //form that inckude map

	 
       const target=event.target;
       const target_id=event.target.id;
	   //default kat and lan 
	   const latLang={ lat:-30.05947, lng:31.3283332 };
	   //default element map
	   let mapElement=document.getElementById("map");
	   //serch box element
	   const searchBoxElement=target.querySelector("input[name='address']")??target.querySelector("input[name='adress']");
	   
	   if(target_id.includes("edit")){

		mapElement=document.getElementById("map_edit");
		


	   }
	 
    //create map instance
	const map = new google.maps.Map(mapElement, {
	center: { lat:30.0847243, lng:31.3968261},
	zoom: 13,
	mapTypeId: "roadmap",
  });

  // Create the search box and link it to the UI element.

  const searchBox = new google.maps.places.SearchBox(searchBoxElement);

//   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
	searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
	const places = searchBox.getPlaces();
	console.log(places[0]);
	var location=places[0].geometry.location;
	var lat =location.lat();
	var lng=location.lng();
     $("input[name='add_lat']").val(location.lat());
     $("input[name='add_lang']").val(location.lng());
     $("input[name='edit_lat']").val(location.lat());
     $("input[name='edit_lang']").val(location.lng());
     $("input[name='address']").val(places[0].formatted_address);
     $("input[name='adress']").val(places[0].formatted_address);

	if (places.length == 0) {
	  return;
	}
	// Clear out the old markers.
	markers.forEach((marker) => {
		
	  marker.setMap(null);
	});

	markers = [];

	// For each place, get the icon, name and location.
	const bounds = new google.maps.LatLngBounds();
   
	places.forEach((place) => {
	  if (!place.geometry || !place.geometry.location) {
		console.log("Returned place contains no geometry");
		return;
	  }

	  const icon = {
		url: place.icon,
		size: new google.maps.Size(71, 71),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(17, 34),
		scaledSize: new google.maps.Size(25, 25),
	  };

	  // Create a marker for each place.
	  markers.push(
		new google.maps.Marker({
		  map,
		  icon,
		  title: place.name,
		  position: place.geometry.location,
		})
	  );
	  if (place.geometry.viewport) {
		// Only geocodes have viewport.
		bounds.union(place.geometry.viewport);
	  } else {
		bounds.extend(place.geometry.location);
	  }
	});
	map.fitBounds(bounds);
  });


  
    map.addListener("click",function (mapMouseEvent) {
	var location=mapMouseEvent.latLng;
    var geocoder=new google.maps.Geocoder(); 
	geocoder.geocode({location :location},function (places,geoStatus) {

	
		$("input[name='address']").val(places[0].formatted_address);
		$("input[name='adress']").val(places[0].formatted_address);

		
	});


	 
	 $("input[name='add_lat']").val(location.lat());
     $("input[name='add_lang']").val(location.lng());
	 $("input[name='edit_lat']").val(location.lat());
     $("input[name='edit_lang']").val(location.lng());


	 markers.forEach((marker) => {
		
		marker.setMap(null);
	  });

	 markers=[];

	 markers.push(
			new google.maps.Marker({
		  map,
		  position:location,
		})
	  );
	  
  });

  $("#"+target_id).on("edit_form_filled",function(e,data){
	 
   let location=new google.maps.LatLng(data.lati, data.longi);
	markers.push(
			new google.maps.Marker({
		  map,
		  position:location,
		})
	  );
	  let bounds = new google.maps.LatLngBounds();

	  map.panTo(location);


})


  });
 





}



	</script>

<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMtllOMzchTUwJ_FCi1SstrTWrD5yhO3w&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>


