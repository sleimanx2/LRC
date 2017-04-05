
function initMap()
{
    var mapOptions = {
        center: {lat: 33.891995, lng: 35.501337},
        zoom: 9
    };
    window.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function moveMap() {
    // Getting coordinates
    var location_coordinates = new google.maps.LatLng(location_latitude.val(), location_longitude.val());

    //Removing location marker if available
    if (location_marker !== null) {
        location_marker.setMap(null);
    }

    // Setting up the location marker.
    var location_pinColor = "E74C3C";
    var location_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + location_pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0, 0),
        new google.maps.Point(10, 34));

    location_marker = new google.maps.Marker({
        position: location_coordinates,
        map: map,
        title: location_name.val(),
        icon: location_pinImage
    });

    console.log(destination_latitude);
    console.log(destination_longitude);

    if(destination_latitude && destination_longitude) {

        var destination_coordinates = new google.maps.LatLng(destination_latitude.val(), destination_longitude.val());

        //Removing destination marker if available
        if (destination_marker !== null) {
            destination_marker.setMap(null);
        }
        // Setting up the location marker.
        var destination_pinColor = "27AE60";
        var destination_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + destination_pinColor,
            new google.maps.Size(21, 34),
            new google.maps.Point(0, 0),
            new google.maps.Point(10, 34));

        destination_marker = new google.maps.Marker({
            position: destination_coordinates,
            map: map,
            title: destination_name.val(),
            icon: destination_pinImage
        });
    }

    // Moving the map to the marker
    map.panTo(location_coordinates);
    map.setZoom(12);

}