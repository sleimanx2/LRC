<?php


namespace LRC\Data\Emergencies;


use Carbon\Carbon;
use LRC\Data\Contacts\Contact;
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
    function __construct(Emergency $emergency, ReportCategory $reportCategory, Ambulance $ambulance , Contact $contact)
    {
        $this->emergency      = $emergency;
        $this->reportCategory = $reportCategory;
        $this->ambulance      = $ambulance;
        $this->contact        = $contact;
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
    /**
     * update emergency
     * @param  arrayable $data new data
     * @param  Emergency $emergency the emergency that we want to update
     * @return boolean
     */
    public function update($data, Emergency $emergency)
    {
        $attributes = $this->fillAttributes($data);

        $emergency->fill($attributes);

        return $emergency->save();
    }

    /**
     * 
     * update the emergency statues (start , patient reached , patient transfared and end datetime )
     * 
     */
    public function updateStatus($status,$datetime=null,Emergency $emergency)
    {
        // if the the datetime is not assigned fill it with the current time.
        if(! $datetime)
        {
            $datetime  = Carbon::now();
        }

        $emergency->$status = $datetime;
        return $emergency->save();
    }

    /**
     * function to update casulties count
     * @param  $id emergency id
     * @return boolean 
     */
    public function updateCasualtiesStatistics($id)
    {
        $emergency = $this->findOrFail($id);

        $casualties_count = $emergency->casualties_count();

        $emergency['casualties_count'] = $casualties_count;

        return $emergency->save();
    }

    /**
     * destroy an emergency
     * 
     * @param  $id emergency id
     * @return boolean  
     */
    public function destroy($id)
    {
        return $this->emergency->destroy($id);
    }

    /**
     * get todays emergency report
     * 
     * @return report
     */
    public function getTodayReport()
    {
        return $this->emergency->select('report_category_id', DB::raw('count(*) as total'))
            ->groupBy('report_category_id')
            ->whereBetween('created_at',[Carbon::today(),Carbon::tomorrow()])
            ->get();
    }

    /**
     * get active emergencies 
     * 
     * @return report
     */
    public function getActiveEmergencies()
    {
        return $this->emergency->with(['report_category'])->where('end_time',null)->get();
    }

    /**
     * @param $data
     * @return array
     */
    private function fillAttributes($data)
    {   
        // if the user chose a hospital instead of manualy filling the destination
        // fill the destination value from the hospital info
        if($data['destination_hospital_id'] != '')
        {
            $contact = $this->contact->find($data['destination_hospital_id']);

            $data['destination'] = $contact->name;
            $data['destination_latitude']  = $contact->latitude;
            $data['destination_longitude'] = $contact->longitude;
        }

        $attributes = [
            'contact_name'            => $data['contact_name'],
            'phone_primary'           => $data['phone_primary'],
            'phone_secondary'         => $data['phone_secondary'],
            'location'                => $data['location'],
            'location_latitude'       => $data['location_latitude'],
            'location_longitude'      => $data['location_longitude'],
            'destination'             => $data['destination'],
            'destination_latitude'    => $data['destination_latitude'],
            'destination_longitude'   => $data['destination_longitude'],
            'destination_hospital_id' => $data['destination_hospital_id'],
            'note'                    => $data['note'],
            'ambulance_id'            => $data['ambulance_id'],
            'report_category_id'      => $data['report_category_id'],
            'driver_id'               => $data['driver_id'],
            'scout_id'                => $data['scout_id'],
            'patient_aider_id'        => $data['patient_aider_id'],
            'assistant_id'            => $data['assistant_id'],
            'start_time'              => $data['start_time'],
            'reach_time'              => $data['reach_time'],
            'transfer_time'           => $data['transfer_time'],
            'end_time'                => $data['end_time']
        ];
        return $attributes;
    }

}