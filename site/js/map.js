var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;



jQuery(function ($)

{
	directionsDisplay = new google.maps.DirectionsRenderer();
	var lat=$('#lat').val();
	var lng=$('#lng').val();
	var map=$('.map').attr('id');
	var latlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
	  zoom: 14,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById('map'), myOptions);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById("indi"));		

	var icon = new google.maps.Marker({
	position: latlng,
	map: map
	})

	$('form.percorsomap').submit(function(e){
		e.preventDefault();
		percorso (lat, lng);
	});

});



 function percorso (lat, lng)

 {
	var request = {
		origin: $('#origine').val(),
		destination: new google.maps.LatLng(lat, lng),
		travelMode: google.maps.TravelMode.DRIVING,
		unitSystem: google.maps.UnitSystem.METRIC,
		provideRouteAlternatives: false,
	}

	directionsService.route(request, function(result, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(result);
		}
	});

}