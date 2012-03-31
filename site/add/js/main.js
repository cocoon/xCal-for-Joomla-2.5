//Useful links:
// http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
// http://code.google.com/apis/maps/documentation/javascript/services.html#Geocoding
// http://jqueryui.com/demos/autocomplete/#remote-with-cache
      
var geocoder;
var map;
var marker;
    
function initialize(coord){
//MAP
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
    draggable: false,
  position: latlng
  });
        
}
    
$(document).ready(function() { 
  coordinate=$('span#coord'+$('#location_id option[selected="selected"]').attr('value')).html();
  if(coordinate){
    initialize(coordinate);
  }
  $('#location_id option').live('click', function(){
    coordinate=$('span#coord'+$(this).attr('value')).html();
    initialize(coordinate);
  });
          

  
});