/**
 * Created by Borregana on 24/07/14.
 */


function initialize() {

    var mapOptions = {
        center: new google.maps.LatLng(39.8867882,-0.0867385,15),
        zoom: 14
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

    var contentString = '<div>';

    var infoWindow = new google.maps.InfoWindow({
        content: contentString
    });

}

google.maps.event.addDomListener(window, 'load', initialize);

