<span data-ng-controller="locationFormCtrl">

      <h3>Contact Information</h3><hr/>
<div class="form-group">
    <label for="">Contact Name</label>
    {!! Form::text('contact_name', old('contact_name'), ['class' =>
    'form-control']) !!}
</div>
<div class="form-group">
    <label for="">Phone Primary</label>
    {!! Form::text(
    'phone_primary',old('phone_primary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits','required'=>'required']) !!}
</div>
<div class="form-group">
    <label for="">Phone Secondary</label>
    {!! Form::text(
    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
    <h3>Team Information</h3>
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Driver</label>

            {!! Form::select('driver_id',$data['drivers'],
            old('driver_id')) !!}
        </div>
        <div class="col-md-6">
            <label for="">Scout</label>
            {!! Form::select('scout_id',$data['seniors'],
            old('scout_id')) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Patient Aider</label>
            {!! Form::select('patient_aider_id',$data['seniors'],
            old('patient_aider_id')) !!}
        </div>
        <div class="col-md-6">
            <label for="">Assistant</label>
            {!! Form::select('assistant_id',$data['allUsers'],
            old('assistant_id')) !!}
        </div>
    </div>
</div>
    <h3>Emergency Information</h3>
    <hr/>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">Report Category</label>
                {!! Form::select('report_category_id',$data['report_categories'],
                old('report_category_id')) !!}
            </div>
            <div class="col-md-6">
                <label for="">Ambulance</label>
                {!! Form::select('ambulance_id',$data['ambulances'],
                old('ambulance_id')) !!}
            </div>
        </div>
    </div>
    {{--location partial start--}}
    @include('partials.location',['prefix'=>'location'])
    {{--location partial end--}}

    {{--destination partial start--}}
    <!-- Google location  -->
    @include('partials.destination',['prefix'=>'destination'])
    <!--  Local contact locations -->
    <p>--- Or chose a hospital ---</p> 
    {!! Form::select('destination_hospital_id',$data['hospitals']+[''],
                old('destination_hospital_id')) !!}
    <br><br>
    {{--destination partial end--}}
    <div class="form-group">
        <div class="ui-map" id="map-canvas"></div>
    </div>
    <hr/>
    <label for="">Note</label>
    {!! Form::textarea(
    'note',old('note'),['class'=>'form-control','']) !!}
    <hr/>
    <button type="submit" class="btn btn-success">
        Save
    </button>
    <button class="btn btn-default" type="reset">Revert Changes
    </button>
</span>