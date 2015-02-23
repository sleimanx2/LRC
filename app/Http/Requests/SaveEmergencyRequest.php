<?php namespace LRC\Http\Requests;

use LRC\Http\Requests\Request;

class SaveEmergencyRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'phone_primary'      => 'required|min:8|max:8',
            'phone_secondary'    => 'min:8|max:8',
            'location'           => 'required',
            'location_latitude'  => 'required',
            'location_longitude' => 'required',
            'driver_id'          => 'required|exists:users,id',
            'scout_id'           => 'required|exists:users,id',
            'patient_aider_id'   => 'required|exists:users,id',
            'assistant_id'       => 'required|exists:users,id',
            'report_category_id' => 'required',
            'ambulance_id'       => 'required',

        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'location.required'           => 'Location not found',
            'location_latitude.required'  => 'Make sure you select a valid suggested location',
            'location_longitude.required' => 'Make sure you select a valid suggested location'
        ];
    }

}
