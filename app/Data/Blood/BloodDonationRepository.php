<?php


namespace LRC\Data\Blood;


class BloodDonationRepository {

    /**
     * @var BloodDonation
     */
    private $bloodDonation;


    /**
     * @param BloodDonation $bloodDonation
     */
    function __construct(BloodDonation $bloodDonation)
    {
        $this->bloodDonation = $bloodDonation;
    }

    /**
     * Create a new blood donation
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        $platelets = 0;
        $blood     = 0;

        if ( $data['donation_type'] == 'platelets' )
        {
            $platelets = 1;
        } else
        {
            $blood = 1;
        }

        $data = [
            'user_id'          => $data['user_id'],
            'donor_id'         => $data['donor_id'],
            'blood_request_id' => $data['blood_request_id'],
            'blood'            => $blood,
            'platelets'        => $platelets,
            'will_donate_on'   => date('Y-m-d', $data['will_donate_on']),
            'time'             => $data['time']
        ];

        return $this->bloodDonation->create($data);
    }

    /**
     * It destroy all the donation of a donor for a blood request
     * @param $donorId
     * @param $bloodRequestId
     */
    public function destroyRelatedDonation($donorId, $bloodRequestId)
    {
        return $this->bloodDonation->where('donor_id', $donorId)->where('blood_request_id', $bloodRequestId)->delete();
    }
}