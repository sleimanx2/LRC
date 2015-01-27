<?php namespace LRC\Http\Requests;

use LRC\Http\Requests\Request;

class SaveContact extends Request {

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
            'name'            => 'required|max:255|min:2|unique:contacts,name',
            'phone_primary'   => 'required|min:8|max:8',
            'phone_secondary' => 'min:8|max:8',
            'location'        => 'required',
            'latitude'        => 'required',
            'longitude'       => 'required',
            'category_id'     => 'required'
        ];

        if ( $this->route()->getName() == 'contact-update')
        {
            $rules['name'] = $rules['name'].','.$this->route()->getParameter('id');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            [
                'category_id.required' => 'You should provide a valid category',
                'location.required'    => 'Location not found',
                'latitude.required'    => 'We cant find latitude or logitude',
                'longitude.required'   => 'Make sure you select a valid suggested location'
            ]
        ];
    }

}
