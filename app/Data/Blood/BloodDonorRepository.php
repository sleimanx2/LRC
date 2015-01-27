<?php


namespace LRC\Data\Blood;

use Illuminate\Support\Facades\DB;

class BloodDonorRepository {


    /**
     * @var BloodDonor
     */
    private $bloodDonor;
    /**
     * @var BloodType
     */
    private $bloodType;

    /**
     * @param BloodDonor $bloodDonor
     * @param BloodType $bloodType
     */
    function __construct(BloodDonor $bloodDonor, BloodType $bloodType)
    {
        $this->bloodDonor = $bloodDonor;
        $this->bloodType  = $bloodType;
    }


    public function findOrFail($id)
    {
        return $this->bloodDonor->findOrFail($id);
    }

    public function getPaginated($limit = 25)
    {
        $bloodDonors = $this->bloodDonor->paginate($limit);

        return $bloodDonors;

    }

    /**
     * Function that finds blood blood donors by first_name and last_name | paginated
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function searchPaginated($query, $limit = 25)
    {
        $query = str_replace(" ", "%", '%' . $query . '%');

        $bloodDonors = $this->bloodDonor
            ->select('*')
            ->where(DB::raw('concat_ws(" ",first_Name,last_Name)'), 'like', $query)
            ->paginate($limit);

        return $bloodDonors;
    }


    public function getBloodTypesList()
    {
        return $this->bloodType->all()->lists('name', 'id');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        $data = [
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'blood_type_id'   => $data['blood_type_id'],
            'email'           => $data['email'],
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ];

        return $this->bloodDonor->create($data);
    }


    /**
     * @param array $data
     * @param BloodDonor $bloodDonor
     * @return bool
     */
    public function update(array $data, BloodDonor $bloodDonor)
    {
        $attributes = [
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'blood_type_id'   => $data['blood_type_id'],
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ];

        if ( $bloodDonor->email != $data['email'] )
        {
            $attributes['email'] = $data['email'];
        }

        $bloodDonor->fill($attributes);

        return $bloodDonor->save();

    }

    public function destroy($id)
    {
        return $this->bloodDonor->destroy($id);
    }


}