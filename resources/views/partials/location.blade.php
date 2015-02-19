{{--data setup start--}}
<?php $prefix = isset($prefix) ? $prefix.'_' : '';  ?>
{{--data setup end--}}
<div class="form-group">
    {!! Form::hidden('location', old('location')
    ,['id'=>'location','class'=>'form-control','data-ng-value'=>'form.location']) !!}
    <label for="">Location</label>
    <google-location location=location></google-location>
</div>
<div class="form-group">
    {!! Form::hidden($prefix.'latitude', old($prefix.'latitude')
    ,['id'=>'location_latitude','class'=>'form-control','data-ng-model'=>'form.location_latitude','data-ng-value'=>'form.location_latitude']) !!}

    {!! Form::hidden($prefix.'longitude', old($prefix.'longitude')
    ,['id'=>'location_longitude','class'=>'form-control','data-ng-model'=>'form.location_longitude','data-ng-value'=>'form.location_longitude'])
    !!}
</div>