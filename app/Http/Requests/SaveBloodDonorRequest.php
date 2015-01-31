<?php namespace LRC\Http\Requests;

use LRC\Http\Requests\Request;

class SaveBloodDonorRequest extends Request {

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
            'first_name'      => 'required|max:255|min:2',
            'last_name'       => 'required|max:255|min:2',
            'email'           => 'required|max:255|unique:blood_donors,email',
            'phone_primary'   => 'required|min:8|max:8',
            'phone_secondary' => 'min:8|max:8',
            'location'        => 'required',
            'latitude'        => 'required',
            'longitude'       => 'required',
            'blood_type_id'   => 'required',
            'gender'          => 'required',
            'birthday'        => 'date|before:' .(date('Y')-18)."-".date('m')."-".date('d'),
        ];

        if ( $this->route()->getName() == 'blood-donor-update' )
        {
            $rules['email'] = $rules['email'] . ',' . $this->route()->getParameter('id');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'blood_type_id.required' => 'You should provide a valid category',
            'location.required'      => 'Location not found',
            'latitude.required'      => 'We cant find latitude or longitude',
            'longitude.required'     => 'Make sure you select a valid suggested location',
            'longitude.required'     => 'Make sure you select a valid suggested location'
        ];
    }
}
