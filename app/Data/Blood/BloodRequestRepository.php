<?php


namespace LRC\Data\Blood;


class BloodRequestRepository {


    /**
     * @var BloodRequest
     */
    private $bloodRequest;

    /**
     * @param BloodRequest $bloodRequest
     */
    function __construct(BloodRequest $bloodRequest)
    {
        $this->bloodRequest = $bloodRequest;
    }

    public function findOrFail($id)
    {
        return $this->bloodRequest->findOrFail($id);
    }

    /**
     * Finds blood requests paginated
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $bloodRequests = $this->bloodRequest->with('blood_type', 'blood_bank')->orderBy('completed', 'asc')->orderBy('due_date')->paginate($limit);

        return $bloodRequests;

    }

    /**
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function searchPaginated($query, $limit = 25)
    {
        $query = str_replace(" ", "%", '%' . $query . '%');

        $bloodRequests = $this->bloodRequest
            ->select('*')
            ->with('blood_type', 'blood_bank')
            ->where('patient_name', 'like', $query)
            ->paginate($limit);

        return $bloodRequests;
    }

    /**
     * @param $data
     * @return static
     */
    public function store($data)
    {
        $attributes = [
            'patient_name'       => $data['patient_name'],
            'patient_age'        => $data['patient_age'],
            'due_date'           => $data['due_date'],
            'blood_type_id'      => $data['blood_type_id'],
            'blood_bank_id'      => $data['blood_bank_id'],
            'blood_quantity'     => $data['blood_quantity'],
            'platelets_quantity' => $data['platelets_quantity'],
            'contact_name'       => $data['contact_name'],
            'phone_primary'      => $data['phone_primary'],
            'phone_secondary'    => $data['phone_secondary'],
            'case'               => $data['case'],
            'note'               => $data['note'],
            'user_id'            => $data['user_id'],
            'completed'          => 0,
            'patient_gender'     => $data['patient_gender'],
            'taken_by'           => $data['taken_by'],
            'received_from'      => $data['received_from'],
        ];

        return $this->bloodRequest->create($attributes);
    }

    /**
     * @param $data
     * @param BloodRequest $bloodRequest
     */
    public function update($data, BloodRequest $bloodRequest)
    {
        $attributes = [
            'patient_name'       => $data['patient_name'],
            'patient_age'        => $data['patient_age'],
            'due_date'           => $data['due_date'],
            'blood_type_id'      => $data['blood_type_id'],
            'blood_bank_id'      => $data['blood_bank_id'],
            'blood_quantity'     => $data['blood_quantity'],
            'platelets_quantity' => $data['platelets_quantity'],
            'contact_name'       => $data['contact_name'],
            'phone_primary'      => $data['phone_primary'],
            'phone_secondary'    => $data['phone_secondary'],
            'case'               => $data['case'],
            'note'               => $data['note'],
            'user_id'            => $data['user_id'],
            'patient_gender'     => $data['patient_gender'],
            'taken_by'           => $data['taken_by'],
            'received_from'      => $data['received_from'],
        ];

        $bloodRequest->fill($attributes);

        $bloodRequest->save();

        $this->updateBloodStatistics($bloodRequest);

    }

    /**
     * @param $data
     * @param BloodRequest $bloodRequest
     */
    public function setComplete($data, BloodRequest $bloodRequest)
    {
        $attributes = [
            'user_id'            => $data['user_id'],
            'blood_quantity'     => $bloodRequest['blood_quantity_confirmed'],
            'platelets_quantity' => $bloodRequest['platelets_quantity_confirmed'],
            'completed'          => 1,
        ];

        $bloodRequest->fill($attributes);

        $bloodRequest->save();

    }

    /**
     * @param BloodRequest $bloodRequest
     */
    public function updateBloodStatistics(BloodRequest $bloodRequest)
    {
        $blood_count     = $bloodRequest->blood_donations_count();
        $platelets_count = $bloodRequest->platelets_donations_count();
        $unconfirmedDonation = $bloodRequest->unconfirmed_blood_donations_count();

        $bloodRequest['confirmed']                    = 0;
        $bloodRequest['completed']                    = 0;
        $bloodRequest['blood_quantity_confirmed']     = $blood_count;
        $bloodRequest['platelets_quantity_confirmed'] = $platelets_count;

        if ( $bloodRequest['blood_quantity'] <= $blood_count and $bloodRequest['platelets_quantity'] <= $platelets_count )
        {
            $bloodRequest['completed'] = 1;
        }

        if ( ! $unconfirmedDonation )
        {
            $bloodRequest['confirmed'] = 1;
        }

        $bloodRequest->save();

    }

    /**
     * @return mixed
     */
    public function findRemaining()
    {
        return $this->bloodRequest->with('blood_type')->where('completed', '=', 0)->orderBy('due_date')->get();
    }

    /**
     * It gets all the blood requests that are completed but not confirmed.
     * @return mixed
     */
    public function findRemainingForConfirmation()
    {
        return $this->bloodRequest->with('blood_type')->where('completed', '=', 1)->where('confirmed','!=',1)->orderBy('due_date')->get();
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->bloodRequest->destroy($id);
    }
}