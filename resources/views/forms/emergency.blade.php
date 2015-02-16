<span data-ng-controller="locationFormCtrl">
<div class="form-group">
    <label for="">Patient Name</label>
    {!! Form::text('patient_name', old('patient_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Parent Name</label>
    {!! Form::text('parent_name', old('parent_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Phone Primary</label>
    {!! Form::text(
    'phone_primary',old('phone_primary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
<div class="form-group">
    <label for="">Phone Secondary</label>
    {!! Form::text(
    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
<div class="form-group">
    <label for="">Report Category</label>
    {!! Form::select('report_category_id',$report_categories,
    old('report_category_id'), ['class' => 'form-control']) !!}
</div>
    <div class="form-group">
        <label for="">Ambulance</label>
        {!! Form::select('ambulance_id',$ambulance_id,
        old('ambulance_id'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="">Driver</label>
        {!! Form::select('driver_id',$driver_id,
        old('driver_id'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for=""></label>
        {!! Form::select('ambulance_id',$ambulance_id,
        old('ambulance_id'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="">Ambulance</label>
        {!! Form::select('ambulance_id',$ambulance_id,
        old('ambulance_id'), ['class' => 'form-control']) !!}
    </div>
<hr/>
<div class="form-group">
    {!! Form::hidden('location', old('location')
    ,['id'=>'location','class'=>'form-control','data-ng-value'=>'form.location']) !!}
    <google-places location=location></google-places>
</div>
<div class="form-group">

    {!! Form::hidden('location_latitude', old('location_latitude')
    ,['id'=>'location_latitude','class'=>'form-control','data-ng-model'=>'form.location_latitude','data-ng-value'=>'form.location_latitude'])
    !!}

    {!! Form::hidden('location_longitude', old('location_longitude')
    ,['id'=>'location_longitude','class'=>'form-control','data-ng-model'=>'form.location_longitude','data-ng-value'=>'form.location_longitude'])
    !!}

</div>

<div class="form-group">
    {!! Form::hidden('destination', old('destination')
    ,['id'=>'destination','class'=>'form-control','data-ng-value'=>'form.destination']) !!}
    <google-places location=location></google-places>
</div>
<div class="form-group">
    {!! Form::hidden('destination_latitude', old('destination_latitude')
    ,['id'=>'destination_latitude','class'=>'form-control','data-ng-model'=>'form.destination_latitude','data-ng-value'=>'form.destination_latitude'])
    !!}

    {!! Form::hidden('destination_longitude', old('destination_longitude')
    ,['id'=>'destination_longitude','class'=>'form-control','data-ng-model'=>'form.destination_longitude','data-ng-value'=>'form.destination_longitude'])
    !!}
</div>

<div class="form-group">
    <div class="ui-map" id="map-canvas"></div>
</div>
<hr/>
    {!! Form::text(
    'note',old('note'),['class'=>'form-control']) !!}
<hr/>
<button type="submit" class="btn btn-success">
    Save
</button>
<button class="btn btn-default" type="reset">Revert Changes
</button>
</span>