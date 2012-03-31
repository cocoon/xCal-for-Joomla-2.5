//Useful links:
// http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
// http://code.google.com/apis/maps/documentation/javascript/services.html#Geocoding
// http://jqueryui.com/demos/autocomplete/#remote-with-cache
      
var geocoder;
var map;
var marker;
    
function initialize(){
//MAP
  var coord=$('#jform_coordinate').attr('value');
  excoord=coord.split(', ');
  lat=excoord[0];
  lng=excoord[1];
  var latlng = new google.maps.LatLng(lat, lng);
  var options = {
    zoom: 16,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
        
  map = new google.maps.Map(document.getElementById("map_canvas"), options);
        
  //GEOCODER
  geocoder = new google.maps.Geocoder();

  // marker
  var image = new google.maps.MarkerImage('../media/com_xcal/images/image.png',
      new google.maps.Size(40, 35),
      new google.maps.Point(0,0),
      new google.maps.Point(20, 30));
  var shadow = new google.maps.MarkerImage('../media/com_xcal/images/shadow.png',
      new google.maps.Size(62, 35),
      new google.maps.Point(0,0),
      new google.maps.Point(20, 30));
  var shape = {
      coord: [1, 1, 1, 40, 40, 40, 40, 1],
      type: 'poly'
  };
        
  marker = new google.maps.Marker({
    map: map,
    shadow: shadow,
    icon: image,
    shape: shape,
    draggable: true,
	position: latlng
  });
				
}
		
$(document).ready(function() { 
         
  initialize();
				  
  $(function() {
    $("#jform_address").autocomplete({
      //This bit uses the geocoder to fetch address values
      source: function(request, response) {
        geocoder.geocode( {'address': request.term }, function(results, status) {
          response($.map(results, function(item) {
            return {
              label:  item.formatted_address,
              value: item.formatted_address,
              latitude: item.geometry.location.lat(),
              longitude: item.geometry.location.lng()
            }
          }));
        })
      },
      //This bit is executed upon selection of an address
      select: function(event, ui) {
        var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
        marker.setPosition(location);
        map.setCenter(location);
        $('#jform_coordinate').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
      }
    });
  });
	
  //Add listener to marker for reverse geocoding
  google.maps.event.addListener(marker, 'drag', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          $('#jform_address').val(results[0].formatted_address);
          $('#jform_coordinate').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
        }
      }
    });
  });
  
});