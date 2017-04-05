{{--data setup start--}}
<?php $prefix = isset($prefix) ? $prefix.'_' : '';  ?>
{{--data setup end--}}
<div class="form-group">
    {!! Form::hidden('destination', old('destination')
    ,['id'=>'destination','class'=>'form-control','data-ng-value'=>'form.destination']) !!}
    <label for="">Destination</label>
    <input id="google_places_destination" placeholder="Enter a Destination" name="google_places_destination" type="text" class="form-control"  required/>

</div>
<div class="form-group">
    {!! Form::hidden($prefix.'latitude', old($prefix.'latitude')
    ,['id'=>'destination_latitude','class'=>'form-control','data-ng-model'=>'form.destination_latitude','data-ng-value'=>'form.destination_latitude']) !!}

    {!! Form::hidden($prefix.'longitude', old($prefix.'longitude')
    ,['id'=>'destination_longitude','class'=>'form-control','data-ng-model'=>'form.destination_longitude','data-ng-value'=>'form.destination_longitude'])
    !!}
</div>

<script>

    var destination_name =  $('#destination');
    var destination_latitude = $('#destination_latitude');
    var destination_longitude = $('#destination_longitude');
    var destination_marker = null;

    $( document ).ready(function() {

        initMap();

        var autocomplete = new google.maps.places.Autocomplete($("#google_places_destination")[0], {
            types: ['(cities)'],
            componentRestrictions: {country: "lb"}
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            // Getting place info from autocomplete
            var place = autocomplete.getPlace();

            destination_name.val(place.formatted_address);
            destination_latitude.val(place.geometry.location.lat());
            destination_longitude.val(place.geometry.location.lng());

            moveMap();
        });

    });

</script>