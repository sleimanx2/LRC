{{--data setup start--}}
<?php $prefix = isset($prefix) ? $prefix.'_' : '';  ?>
{{--data setup end--}}
<div class="form-group">
    {!! Form::hidden('destination', old('destination')
    ,['id'=>'destination','class'=>'form-control','data-ng-value'=>'form.destination']) !!}
    <label for="">Destination</label>
    <google-destination  placeholder="Enter a destination"></google-destination>
</div>
<div class="form-group">
    {!! Form::hidden($prefix.'latitude', old($prefix.'latitude')
    ,['id'=>'destination_latitude','class'=>'form-control','data-ng-model'=>'form.destination_latitude','data-ng-value'=>'form.destination_latitude']) !!}

    {!! Form::hidden($prefix.'longitude', old($prefix.'longitude')
    ,['id'=>'destination_longitude','class'=>'form-control','data-ng-model'=>'form.destination_longitude','data-ng-value'=>'form.destination_longitude'])
    !!}
</div>