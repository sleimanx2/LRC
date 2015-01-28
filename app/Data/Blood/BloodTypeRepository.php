<?php


namespace LRC\Data\Blood;


class BloodTypeRepository {

    /**
     * @var BloodType
     */
    private $bloodType;


    /**
     * @param BloodType $bloodType
     */
    function __construct(BloodType $bloodType)
    {
        $this->bloodType = $bloodType;
    }


    public function getList()
    {
        return $this->bloodType->all()->lists('name', 'id');
    }

}