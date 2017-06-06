<?php $prefix = isset($prefix) ? $prefix.'_' : '';  ?>

<div class="form-group">
    {!! Form::hidden('location', old('location'), ['id' => 'location', 'class'=>'form-control']) !!}
    <label for="">Location</label>
    <input id="google_places_location" name="google_places_location" type="text" class="form-control" value="{{ old('location') }}"/>
</div>
<div class="form-group">
    {!! Form::hidden($prefix.'latitude', old($prefix.'latitude'), ['id' => 'location_latitude', 'class'=>'form-control']) !!}
    {!! Form::hidden($prefix.'longitude', old($prefix.'longitude'), ['id' => 'location_longitude', 'class'=>'form-control']) !!}
</div>

<script>
    var location_name =  $('#location');
    var location_latitude = $('#location_latitude');
    var location_longitude = $('#location_longitude');
    var location_marker = null;

    var autocomplete_field = $("#google_places_location");

    $(document).ready(function() {
        initMap();

        var autocomplete = new google.maps.places.Autocomplete(autocomplete_field[0], {
            componentRestrictions: {country: "lb"}
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            // Getting place info from autocomplete
            var place = autocomplete.getPlace();

            location_name.val(place.formatted_address);
            location_latitude.val(place.geometry.location.lat());
            location_longitude.val(place.geometry.location.lng());

            moveMap();
        });

        // Try to set initial location from database
        if($("#location_latitude").val() && $("#location_longitude").val()) {
            moveMap();
            autocomplete_field.val($("#location").val());
            // new google.maps.Geocoder().geocode( { 'address': $("#location").val() }, function(results, status) {
            //     if (status == google.maps.GeocoderStatus.OK) {
            //         var place = results[0];

            //         location_name.val(place.formatted_address);
            //         location_latitude.val(place.geometry.location.lat());
            //         location_longitude.val(place.geometry.location.lng());

            //         autocomplete_field.val(place.formatted_address);

            //         moveMap();
            //     }
            // });
        }
    });
</script>