<?php namespace LRC\Http\Requests;

use LRC\Http\Requests\Request;

class UpdateEmergencyStatusRequest extends Request {

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
            'status' => 'required|in:start_time,reach_time,transfer_time,end_time',
        ];

        return $rules;
    }


}
