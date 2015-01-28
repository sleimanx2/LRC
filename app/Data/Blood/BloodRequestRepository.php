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

    /**
     * Finds blood requests paginated
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $bloodRequests = $this->bloodRequest->with('blood_type','blood_bank')->paginate($limit);

        return $bloodRequests;

    }

}