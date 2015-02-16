<?php


namespace LRC\Data\Emergencies;


class EmergencyRepository {

    /**
     * @var Emergency
     */
    private $emergency;


    /**
     * @param Emergency $emergency
     */
    function __construct(Emergency $emergency)
    {
        $this->emergency = $emergency;
    }

    /**
     * It paginates emergencies
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        return $this->emergency->paginate($limit);
    }


}