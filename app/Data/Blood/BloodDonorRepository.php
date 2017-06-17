<?php

namespace LRC\Data\Blood;

use Carbon\Carbon;
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
        // Get donors by straight-line lat-long distance calculation
        $bloodDonors = $this->bloodDonor
            ->select('*', DB::raw('
            ( 6371 * acos( cos( radians(' . $options['latitude'] . ') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians(' . $options['longitude'] . ')) + sin( radians(' . $options['latitude'] . ') ) * sin( radians(latitude) ) )) AS distance
            '))
            ->where('blood_type_id', $options['blood_type_id'])
            ->where('incapable_till', '<=', date("Y-m-d"))
            ->orderBy('distance')
            ->limit(25)
            ->get();

        // Re-sort donors based on Google Maps API distance and duration calculation
        $apiOrigins = "origins=" . $options['latitude'] . "," . $options['longitude'];
        $apiKey = "key=AIzaSyDohD5KwxyAlD7LK5F_eV8fo0z0Csu3Cfc";
        
        $apiDestinations = "destinations=";
        foreach($bloodDonors as $donor)
            $apiDestinations .= $donor->latitude . "," . $donor->longitude . "|";
        $apiDestinations = substr($apiDestinations, 0, -1);

        $apiURL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&" . $apiOrigins . "&" . $apiDestinations . "&" . $apiKey;
        $apiResult = json_decode(file_get_contents($apiURL));
		
        foreach($bloodDonors as $index => $donor) {
            $donor->distance_value = $apiResult->rows[0]->elements[$index]->distance->value;
            $donor->duration = $apiResult->rows[0]->elements[$index]->duration->value;
            $donor->duration_value = Carbon::now()->addSeconds($donor->duration)->diffForHumans(null, true);
        }

        // Apply the sorting
        $makeComparer = function($criteria) {
            $comparer = function ($first, $second) use ($criteria) {
                foreach ($criteria as $key => $orderType) {
                    $orderType = strtolower($orderType);

                    if ($first[$key] < $second[$key])
                        return $orderType === "asc" ? -1 : 1;
                    else if ($first[$key] > $second[$key])
                        return $orderType === "asc" ? 1 : -1;
                }
                return 0;
            };
            return $comparer;
        };

        $sortCriteria = ["golder_donor" => "desc", "duration" => "asc", "distance_value" => "asc"];

        $comparer = $makeComparer($sortCriteria);
        $sortedDonors = $bloodDonors->sort($comparer);
        
        return $sortedDonors->slice(0, $options['limit'])->values()->all();
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
            'note'            => $data['note'],
            'incapable_till'  => $data['incapable_till'],
			'golden_donor'	  => isset($data['golden_donor']) ? 1 : 0,
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
			'golden_donor'	  => isset($data['golden_donor']) ? 1 : 0,
        ];

        if ( $bloodDonor->email != $data['email'] )
            $attributes['email'] = $data['email'];

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