<?php


namespace LRC\Data\Emergencies;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $this->emergency->with(['report_category', 'casualties'])->orderBy('created_at', 'desc')->paginate($limit);
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
        $attributes = $this->fillAttributes($data);

        return $this->emergency->create($attributes);
    }

    public function update($data, Emergency $emergency)
    {
        $attributes = $this->fillAttributes($data);

        $emergency->fill($attributes);

        return $emergency->save();
    }


    public function updateCasualtiesStatistics($id)
    {
        $emergency = $this->findOrFail($id);

        $casualties_count = $emergency->casualties_count();

        $emergency['casualties_count'] = $casualties_count;

        return $emergency->save();
    }

    public function destroy($id)
    {
        return $this->emergency->destroy($id);
    }


    public function getTodayReport()
    {
        return $this->emergency->select('report_category_id', DB::raw('count(*) as total'))
            ->groupBy('report_category_id')
            ->whereBetween('created_at',[Carbon::today(),Carbon::tomorrow()])
            ->get();
    }

    /**
     * @param $data
     * @return array
     */
    private function fillAttributes($data)
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
            'note'                  => $data['note'],
            'ambulance_id'          => $data['ambulance_id'],
            'report_category_id'    => $data['report_category_id'],
            'driver_id'              => $data['driver_id'],
            'scout_id'              => $data['scout_id'],
            'patient_aider_id'      => $data['patient_aider_id'],
            'assistant_id'          => $data['assistant_id']
        ];
        return $attributes;
    }

}