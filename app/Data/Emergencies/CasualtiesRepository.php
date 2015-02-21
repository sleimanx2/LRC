<?php


namespace LRC\Data\Emergencies;


class CasualtiesRepository {

    /**
     * @var Casualty
     */
    private $casualty;


    /**
     * @param Casualty $casualty
     */
    function __construct(Casualty $casualty)
    {
        $this->casualty = $casualty;
    }

    public function findOrFail($id)
    {
        return $this->casualty->findOrFail($id);
    }

    public function store($data)
    {
        $attributes = [
            'name'         => $data['name'],
            'emergency_id' => $data['emergency_id']
        ];

        return $this->casualty->create($attributes);
    }

    public function update($data,Casualty $casualty)
    {
        $attributes = [
            'name' => $data['name']
        ];

        $casualty->fill($attributes);
        return $casualty->save();
    }
}