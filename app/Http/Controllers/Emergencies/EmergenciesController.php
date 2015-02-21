<?php namespace LRC\Http\Controllers\Emergencies;

use LRC\Data\Contacts\ContactRepository;
use LRC\Data\Emergencies\EmergencyRepository;
use LRC\Data\Users\UserRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Http\Requests\SaveEmergencyRequest;

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
    function __construct(EmergencyRepository $emergencyRepository, UserRepository $userRepository,ContactRepository $contactRepository)
    {
        $this->emergencyRepository = $emergencyRepository;
        $this->userRepository      = $userRepository;
        $this->contactRepository = $contactRepository;
    }

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
        $this->emergencyRepository->store($request->all());

        return redirect()->intended(route('emergencies-list'))->with('success', 'A new emergency was added successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);
        $data = $this->getFormData();

        return view('emergencies.edit', compact('data','emergency'));
    }

    /**
     * @param SaveEmergencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id,SaveEmergencyRequest $request)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $this->emergencyRepository->update($request->all(),$emergency);

        return redirect()->intended(route('emergencies-list'))->with('success', 'A new emergency was added successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->emergencyRepository->destroy($id);

        return redirect()->intended(route('emergencies-list'))->with('success', 'An emergency was successfully deleted.');
    }

    public function manage($id)
    {
        $emergency = $this->emergencyRepository->findOrFail($id);

        $contacts = $this->contactRepository->findBestMatch(['latitude'=>$emergency->latitude,'longitude'=>$emergency->longitude]);

        return view('emergencies.manage',compact('emergency','contacts'));
    }


    /**
     * @return mixed
     */
    private function getFormData()
    {
        $data['report_categories'] = $this->emergencyRepository->getReportCategoriesList();

        $data['ambulances'] = $this->emergencyRepository->getAmbulanceList();

        $data['drivers'] = $this->userRepository->getDriversList();

        $data['seniors'] = $this->userRepository->getSeniorsList();

        $data['allUsers'] = $this->userRepository->getAllList();

        return $data;
    }

}
