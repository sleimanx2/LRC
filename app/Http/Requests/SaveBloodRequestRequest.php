<?php namespace LRC\Http\Requests;

use LRC\Http\Requests\Request;

class SaveBloodRequestRequest extends Request {

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
            'patient_name'       => 'required|max:255|min:2',
            'patient_age'        => 'integer',
            'due_date'           => 'date|after:' . date('yyyy-M-dd', time()),
            'blood_type_id'      => 'required',
            'blood_bank_id'      => 'required',
            'blood_quantity'     => 'integer|min:0',
            'platelets_quantity' => 'integer|min:0',
            'contact_name'       => 'required|max:255|min:2',
            'phone_primary'      => 'required|min:8|max:8',
            'phone_secondary'    => 'min:8|max:8',
        ];

        return $rules;
	}

}
