/*
 * Phonebook Functions
 */
$(document).ready(function() {
    $('#phonebookTable').DataTable({
        "paging": false,
        "info": false,
        "ordering": true,
        "scrollY": ($(window).height() - 125) + "px",
        "scrollCollapse": false,
        "order": [ [1,'desc'], [5,'asc'], [2,'asc'] ],
        "oLanguage": {
            "sEmptyTable": function() { return "No Records Found"; },
            "sZeroRecords": function() { return "No Records Found" }
        }
    });
});

function showPhonebookSidebar() {
    $(".phonebook-sidebar").addClass("open");
}

function hidePhonebookSidebar() {
    $(".phonebook-sidebar").removeClass("open");
}


/*
 * Init a blank google map
 */
function initMap()
{
    var mapOptions = {
        center: {lat: 33.891995, lng: 35.501337},
        zoom: 9
    };
    window.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

/*
* Helper method called when the location is changed in the location/destination fields
*/
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


    if(typeof destination_latitude !== 'undefined') {

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

/*
* Convert all select input to select2 instances
*/
function initSelect2(){
        $("select").select2();
}

function initDateTimePicker(){

    $('.datetimepicker').datetimepicker();
    $('.datepicker').datetimepicker({ format:'YYYY-MM-DD'});
    $('.timepicker').datetimepicker({ format: 'LT'});

}

/*
* Boot function that is called on each page request
*/
function boot(){
    $(document).ready(function() {
        initSelect2();
        initDateTimePicker();
    });
}

boot();