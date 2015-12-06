<?php namespace LRC\Http\Controllers\Emergencies;

use LRC\Http\Requests;
use Illuminate\Http\Request;
use LRC\Data\Users\UserRepository;
use LRC\Http\Controllers\Controller;
use LRC\Data\Contacts\ContactRepository;
use LRC\Http\Requests\SaveEmergencyRequest;
use LRC\Data\Emergencies\EmergencyRepository;
use LRC\Http\Requests\UpdateEmergencyStatusRequest;

class EmergenciesController extends Controller {

    /**
     * @var EmergencyRepository
     */
    private $emergencyRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @param EmergencyRepository $emergencyRepository
     * @param UserRepository $userRepository
     * @param ContactRepository $contactRepository
     */
    function __construct(EmergencyRepository $emergencyRepository, UserRepository $userRepository, ContactRepository $contactRepository)
    {
        $this->emergencyRepository = $emergencyRepository;
        $this->userRepository      = $userRepository;
        $this->contactRepository   = $contactRepository;
    }
    /**
     * Listing emergencies
     */
    public function index()
    {
        $emergencies = $this->emergencyRepository->getPaginated(20);

        return view('emergencies.index', ['emergencies' => $emergencies]);
    }

    /**
     * Create a new emergency
     */
    public function create()
    {
        $data = $this->getFormData();

        return view('emergencies.create', compact('data'));
    }

    /**
     * @param SaveEmergencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveEmergencyRequest $request)
    {
        $emergency = $this->emergencyRepository->store($request->all());

        return redirect()->intended(route('emergency-manage',$emergency->id))->with('success', 'A new emergency was added successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $data = $this->getFormData();

        return view('emergencies.edit', compact('data', 'emergency'));
    }

    /**
     * @param SaveEmergencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, SaveEmergencyRequest $request)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $this->emergencyRepository->update($request->all(), $emergency);

        return redirect()->intended(route('emergency-manage',$emergency->id))->with('success', 'A new emergency was added successfully.');
    }

    /**
     * @param $id emergency id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->emergencyRepository->destroy($id);

        return redirect()->intended(route('emergencies-list'))->with('success', 'An emergency was successfully deleted.');
    }

    /**
     * Manage an emergency
     * @param  $id emergency id
     */
    public function manage($id)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $contacts = $this->contactRepository->findBestMatch(['latitude' => $emergency->location_latitude, 'longitude' => $emergency->location_longitude, 'limit' => 10]);

        return view('emergencies.manage', compact('emergency', 'contacts'));
    }

    /**
     * Update the emergency statues (start , patient reached , patient transfared and end datetime )
     * 
     * @param  $id emergency id
     */
    public function updateStatus($id,UpdateEmergencyStatusRequest $request)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $this->emergencyRepository->updateStatus($request->status,$request->datetime,$emergency);

        return redirect()->intended(route('emergency-manage',$emergency->id))->with('success', 'The emergency status ( '.$request->status.' ) was updated successfully.');
    }


    /**
     * Helper function to get required form data.
     * @return mixed
     */
    private function getFormData()
    {
        $data['report_categories'] = $this->emergencyRepository->getReportCategoriesList();

        $data['ambulances'] = $this->emergencyRepository->getAmbulanceList();

        $data['drivers']  = ['not_found' => 'Select a first aider'] + $this->userRepository->getDriversList();
        $data['seniors']  = ['not_found' => 'Select a first aider'] + $this->userRepository->getSeniorsList();
        $data['allUsers'] = ['not_found' => 'Select a first aider'] + $this->userRepository->getAllList();

        return $data;
    }

}
