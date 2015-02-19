<?php


namespace LRC\Data\Emergencies;


class EmergencyRepository {

    /**
     * @var Emergency
     */
    private $emergency;
    /**
     * @var ReportCategory
     */
    private $reportCategory;
    /**
     * @var Ambulance
     */
    private $ambulance;


    /**
     * @param Emergency $emergency
     * @param ReportCategory $reportCategory
     * @param Ambulance $ambulance
     */
    function __construct(Emergency $emergency, ReportCategory $reportCategory, Ambulance $ambulance)
    {
        $this->emergency      = $emergency;
        $this->reportCategory = $reportCategory;
        $this->ambulance      = $ambulance;
    }

    public function findOrFail($id)
    {
        return $this->emergency->findOrFail($id);
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

    /**
     * Get the list of report categories
     * @return array
     */
    public function getReportCategoriesList()
    {
        return $this->reportCategory->all()->lists('name', 'id');
    }

    /**
     * Get the list of ambulances
     * @return array
     */
    public function getAmbulanceList()
    {
        return $this->ambulance->all()->lists('plate_number', 'id');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->emergency->create([
            'contact_name'          => $data['contact_name'],
            'phone_primary'         => $data['phone_primary'],
            'phone_secondary'       => $data['phone_secondary'],
            'location'              => $data['location'],
            'location_latitude'     => $data['location_latitude'],
            'location_longitude'    => $data['location_longitude'],
            'destination'           => $data['destination'],
            'destination_latitude'  => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'note'                  => $data['note']
        ]);
    }

    public function update($data, Emergency $emergency)
    {
        $attributes = [
            'contact_name'          => $data['contact_name'],
            'phone_primary'         => $data['phone_primary'],
            'phone_secondary'       => $data['phone_secondary'],
            'location'              => $data['location'],
            'location_latitude'     => $data['location_latitude'],
            'location_longitude'    => $data['location_longitude'],
            'destination'           => $data['destination'],
            'destination_latitude'  => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'note'                  => $data['note']
        ];

        $emergency->fill($attributes);

        return $emergency->save();
    }

    public function destroy($id)
    {
        return $this->emergency->destroy($id);
    }


}