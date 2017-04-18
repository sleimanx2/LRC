<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Blood Type</label>
            {!! Form::select('blood_type_id',$allBloodTypes, old('blood_type_id'), ['class'=>'blood-type-select']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Blood Units</label>
            <div class="input-group ui-spinner" data-ui-spinner="">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="up" data-type="plus" data-field="blood_quantity">
                        <i class="fa fa-plus">{{----}}</i>
                    </button>
                </span>
                {!! Form::text('blood_quantity',old('blood_quantity'),['class'=>'input-number form-control', 'min'=>'0' ,'max'=>'100' , 'required'=>true]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="down" data-type="minus" data-field="blood_quantity">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="">Platelets</label>
            <div class="input-group ui-spinner" data-ui-spinner="">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="up" data-type="plus" data-field="platelets_quantity">
                        <i class="fa fa-plus">{{----}}</i>
                    </button>
                </span>
                {!! Form::text('platelets_quantity',old('platelets_quantity'),['class'=>'input-number form-control', 'min'=>'0' ,'max'=>'100' , 'required'=>true]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="down" data-type="minus" data-field="platelets_quantity">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
            </div>
        </div>
        <!-- <div class="form-group">
            <label for="">Plasma</label>
            <div class="input-group ui-spinner" data-ui-spinner="">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" data-spin="up">
                        <i class="fa fa-plus"></i>
                    </button>
                </span>
                {!! Form::text('plasma_quantity',old('plasma_quantity'),['class'=>'spinner-input form-control','required'=>true]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" data-spin="down">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
            </div>
        </div> -->
    </div>
    <div class="col-md-6">
        <div class="form-group" data-ng-controller="DonateDatepickerCtrl">
            <label for="">Due Date</label>
            <div class="input-group ui-datepicker">
                {!! Form::text('due_date', old('due_date'), [
                'class' => 'form-control datepicker',
                ]) !!}

                <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Received From</label>
                {!! Form::text('received_from', old('received_from'), ['class' =>'form-control']) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="">Received By</label>
                {!! Form::text('received_from', old('received_from'), ['class' =>'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Patient Name</label>

            <div class="input-group">
                {!! Form::text('patient_name', old('patient_name'), ['class' => 'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default btn-toggle-gender" ><i class="fa fa-male"></i></button>
                </div>
                {!! Form::hidden('patient_gender', 'male') !!}
            </div>
            <script>
            $(".btn-toggle-gender").click(function() {
                var gender = $("input[name='patient_gender']").val();

                if(gender == 'male') {
                    $(this).find("i").removeClass("fa-male").addClass("fa-female");
                    $("input[name='patient_gender']").val("female");
                }
                else {
                    $(this).find("i").removeClass("fa-female").addClass("fa-male");
                    $("input[name='patient_gender']").val("male");
                }
            });
            </script>
        </div>
        <div class="form-group">
            <label for="">Patient Age</label>
            {!! Form::input('number','patient_age', old('patient_age'),
            ['class' =>'form-control','min'=>'0','max'=>'150']) !!}
        </div>
        <div class="form-group">
            <label for="">Case</label>
            {!! Form::select('case',['Cancer'=>'Cancer','Anemia'=>'Anemia','Operation'=>'Operation','Other'=>'Other'],
            old('case')) !!}
        </div>
        <!-- <div class="form-group">
            <label for="">Gender</label><br>
            <label for="">Male</label>
            {!! Form::radio('patient_gender', 'male', true); !!}
            &nbsp;&nbsp;
            <label for="">Female</label>
            {!! Form::radio('patient_gender', 'female', false); !!}
        </div> -->
        <!-- <div class="form-group">
            <label for="">Blood Type</label>
            {{-- Form::select('blood_type_id',$bloodTypes,
            old('blood_type_id')) --}}
        </div> -->
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Blood Bank</label>
            {!! Form::select('blood_bank_id',$allBloodBanks,
            old('blood_bank_id')) !!}
        </div>
        <div class="form-group">
            <label for="">Contact Person</label>
            {!! Form::text('contact_name', old('contact_name'), ['class' =>
            'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
        </div>
        <div class="form-group">
            <label for="">Phone Number(s)</label>
            {!! Form::text('phone_primary',old('phone_number'),['class'=>'form-control','pattern'=>'.{8,8}','required'=>true,'title'=>'The
            number should contain 8 digits']) !!}
        </div>
    </div>
</div>

<hr/>

<div class="form-group">
    <label for="">Notes</label>
    {!! Form::textarea(
    'note',old('note'),['class'=>'form-control', 'rows'=>'2']) !!}
</div>

<!-- <button type="submit" class="btn btn-success">
    Save
</button>
<button class="btn btn-default" type="reset">Revert Changes
</button> -->
