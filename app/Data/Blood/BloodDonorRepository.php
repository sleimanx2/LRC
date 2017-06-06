<?php


namespace LRC\Data\Blood;

use Illuminate\Support\Facades\DB;

class BloodDonorRepository {


    /**
     * @var BloodDonor
     */
    private $bloodDonor;


    /**
     * @param BloodDonor $bloodDonor
     * @param BloodType $bloodType
     */
    function __construct(BloodDonor $bloodDonor, BloodType $bloodType)
    {
        $this->bloodDonor = $bloodDonor;
    }


    /**
     * @param $id
     * @return \Illuminate\Support\Collection|static
     */
    public function findOrFail($id)
    {
        return $this->bloodDonor->findOrFail($id);
    }

    public function findBestMatch(array $options = ['latitude' => null, 'logitude' => null, 'blood_type_id' => null, 'limit' => 25])
    {
        $bloodDonors = $this->bloodDonor
            ->select('*', DB::raw('
            ( 6371 * acos( cos( radians(' . $options['latitude'] . ') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians(' . $options['longitude'] . ')) + sin( radians(' . $options['latitude'] . ') ) * sin( radians(latitude) ) )) AS distance
            '))
            ->where('blood_type_id', $options['blood_type_id'])
            ->where('incapable_till', '<=', date("Y-m-d"))
            ->orderBy('golden_donor', 'desc')
            ->orderBy('distance')
            ->limit($options['limit'])
            ->get();

        return $bloodDonors;


    }

    /**
     * Gets blood donors paginated
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $bloodDonors = $this->bloodDonor->with('blood_type')->paginate($limit);

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
            ->with('blood_type')
            ->where(DB::raw('concat_ws(" ",first_Name,last_Name)'), 'like', $query)
            ->paginate($limit);

        return $bloodDonors;
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
            'longitude'       => $data['longitude'],
            'gender'          => $data['gender'],
            'birthday'        => $data['birthday'],
            'note'            => $data['note']
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
            'longitude'       => $data['longitude'],
            'gender'          => $data['gender'],
            'birthday'        => $data['birthday'],
            'note'            => $data['note'],
            'incapable_till'  => $data['incapable_till'],
        ];

        if ( $bloodDonor->email != $data['email'] )
        {
            $attributes['email'] = $data['email'];
        }

        $bloodDonor->fill($attributes);

        return $bloodDonor->save();

    }

    public function postponeDuty($unixTime, BloodDonor $donor)
    {
        $attributes = [
            'incapable_till' => date('Y-m-d', $unixTime)
        ];

        $donor->fill($attributes);

        return $donor->save();
    }

    public function updateNotes($notes, BloodDonor $donor)
    {
        $attributes = [
            'note' => $notes
        ];

        $donor->fill($attributes);

        return $donor->save();
    }

    /**
     * Deletes blood donor
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->bloodDonor->destroy($id);
    }


    public function getTotal()
    {
        return $this->bloodDonor->all()->count();
    }


}