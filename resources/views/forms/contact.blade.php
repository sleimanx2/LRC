<span data-ng-controller="locationFormCtrl">
<div class="form-group">
    <label for="">Name</label>
    {!! Form::text('name', old('name'), ['class' =>
    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Phone Primary</label>
    {!! Form::text(
    'phone_primary',old('phone_number'),['class'=>'form-control','pattern'=>'.{8,8}','required'=>true,'title'=>'The
    number should contain 8 digits']) !!}
    <span></span>
</div>
<div class="form-group">
    <label for="">Phone Secondary</label>
    {!! Form::text(
    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
<div class="form-group">
    <label for="">Category</label>
    {!! Form::select('category_id',$categories,
    old('phone_secondary'), ['class' => 'form-control']) !!}
</div>
<hr/>
<div class="form-group">
    {!! Form::hidden('location', old('location')
    ,['id'=>'location','class'=>'form-control','data-ng-value'=>'form.location']) !!}
    <google-places location=location></google-places>
</div>
<div class="form-group">

    {!! Form::hidden('latitude', old('latitude')
    ,['id'=>'latitude','class'=>'form-control','data-ng-model'=>'form.latitude','data-ng-value'=>'form.latitude']) !!}

    {!! Form::hidden('longitude', old('longitude')
    ,['id'=>'longitude','class'=>'form-control','data-ng-model'=>'form.longitude','data-ng-value'=>'form.longitude'])
    !!}

</div>

<div class="form-group">
    <div class="ui-map" id="map-canvas"></div>
</div>
<hr/>
<button type="submit" class="btn btn-success">
    Save
</button>
<button class="btn btn-default" type="reset">Revert Changes
</button>
</span>