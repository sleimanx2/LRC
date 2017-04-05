{{--data setup start--}}
<?php $prefix = isset($prefix) ? $prefix.'_' : '';  ?>
{{--data setup end--}}
<div class="form-group">
    {!! Form::hidden('location', old('location')
    ,['id'=>'location','class'=>'form-control','data-ng-value'=>'form.location']) !!}
    <label for="">Location</label>
    <input id="google_places_location" name="google_places_location" type="text" class="form-control" data-ng-model="form.location" data-ng-value="form.location" required/>
</div>
<div class="form-group">
    {!! Form::hidden($prefix.'latitude', old($prefix.'latitude')
    ,['id'=>'location_latitude','class'=>'form-control','data-ng-model'=>'form.location_latitude','data-ng-value'=>'form.location_latitude']) !!}

    {!! Form::hidden($prefix.'longitude', old($prefix.'longitude')
    ,['id'=>'location_longitude','class'=>'form-control','data-ng-model'=>'form.location_longitude','data-ng-value'=>'form.location_longitude'])
    !!}
</div>

<script>

    var location_name =  $('#location');
    var location_latitude = $('#location_latitude');
    var location_longitude = $('#location_longitude');
    var location_marker = null;

    $( document ).ready(function() {

        initMap();

        var autocomplete = new google.maps.places.Autocomplete($("#google_places_location")[0], {
            types: ['(cities)'],
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

    });

</script>
