<span data-ng-controller="locationFormCtrl">
    <div class="form-group">
        <label for="">Patient Name</label>
        {!! Form::text('patient_name', old('patient_name'), ['class' =>
        'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
    </div>
    <div class="form-group">
        <label for="">Blood Type</label>
        {!! Form::select('blood_type_id',$bloodTypes,
        old('blood_type_id'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">Quantity Blood</label>

                <div class="input-group ui-spinner" data-ui-spinner="">
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-spin="up">
                        <i class="fa fa-plus"></i>
                    </button>
                    </span>
                    {!! Form::text(
                    'blood_quantity',old('blood_quantity'),['class'=>'spinner-input form-control','required'=>true]) !!}
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" data-spin="down">
                        <i class="fa fa-minus"></i>
                    </button>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <label for="">Quantity Platelets</label>

                <div class="input-group ui-spinner" data-ui-spinner="">
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-spin="up">
                        <i class="fa fa-plus"></i>
                    </button>
                    </span>
                    {!! Form::text(
                    'platelets_quantity',old('platelets_quantity'),['class'=>'spinner-input
                    form-control','required'=>true]) !!}
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default" data-spin="down">
                        <i class="fa fa-minus"></i>
                    </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" data-ng-controller="DatepickerCtrl">
        <label for="">Due Date</label>

        <div class="input-group ui-datepicker">
            {!! Form::text('due_date', old('due_date'), [
            'class' => 'form-control',
            'datepicker-popup'=>'yyyy-M-dd',
            'ng-model'=>'dt',
            'is-open'=>'opened',
            'min'=>'minDate',
            'datepicker-options'=>'dateOptions',
            'date-disabled'=>'disabled(date, mode)',
            'ng-required'=>'true',
            'close-text'=>'Close',
            ]) !!}

            <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="">Blood Bank</label>
        {!! Form::select('blood_bank_id',$bloodBanks,
        old('blood_bank_id'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="">Case</label>
        {!! Form::text(
        'case',old('case'),['class'=>'form-control','required'=>true]) !!}
    </div>

    <hr/>
    <div class="form-group">
        <label for="">Contact Name / Parents</label>
        {!! Form::text('contact_name', old('contact_name'), ['class' =>
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
    <hr/>

    <div class="form-group">
        <label for="">Note</label>
        {!! Form::textarea(
        'note',old('note'),['class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-success">
        Save
    </button>
    <button class="btn btn-default" type="reset">Revert Changes
    </button>
</span>