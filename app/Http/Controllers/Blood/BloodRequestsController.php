<?php namespace LRC\Http\Controllers\Blood;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use LRC\Data\Blood\BloodDonorRepository;
use LRC\Data\Blood\BloodRequestRepository;
use LRC\Data\Blood\BloodTypeRepository;
use LRC\Data\Contacts\Contact;
use LRC\Data\Contacts\ContactRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Http\Requests\SaveBloodRequestRequest;

class BloodRequestsController extends Controller {

    /**
     * @var BloodRequestRepository
     */
    private $bloodRequestRepository;
    /**
     * @var BloodTypeRepository
     */
    private $bloodTypeRepository;
    /**
     * @var ContactRepository
     */
    private $contactRepository;
    /**
     * @var BloodDonorRepository
     */
    private $bloodDonorRepository;

    /**
     * @param BloodRequestRepository $bloodRequestRepository
     * @param BloodTypeRepository $bloodTypeRepository
     * @param ContactRepository $contactRepository
     * @param BloodDonorRepository $bloodDonorRepository
     * @internal param Contact $contact
     */
    function __construct(BloodRequestRepository $bloodRequestRepository, BloodTypeRepository $bloodTypeRepository, ContactRepository $contactRepository, BloodDonorRepository $bloodDonorRepository)
    {

        $this->bloodRequestRepository = $bloodRequestRepository;
        $this->bloodTypeRepository    = $bloodTypeRepository;
        $this->contactRepository      = $contactRepository;
        $this->bloodDonorRepository   = $bloodDonorRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $searchQuery = Input::get('search');

        if ( !$searchQuery )
        {
            $bloodRequests = $this->bloodRequestRepository->getPaginated(15);
        } else
        {
            $bloodRequests = $this->bloodRequestRepository->searchPaginated($searchQuery, 15);
        }

        $bloodTypes = $this->bloodTypeRepository->getList();

        return view('blood.requests.index', ['bloodRequests' => $bloodRequests, 'bloodTypes' => $bloodTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $bloodTypes = $this->bloodTypeRepository->getList();

        $bloodBanks = $this->contactRepository->getBloodBanksList();

        return view('blood.requests.create', ['bloodTypes' => $bloodTypes, 'bloodBanks' => $bloodBanks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveBloodRequestRequest $bloodRequestRequest
     * @return Response
     */
    public function store(SaveBloodRequestRequest $bloodRequestRequest)
    {
        $data = $bloodRequestRequest->all();

        if(Auth::check())
            $data['user_id'] = Auth::user()->id;
        else
            $data['user_id'] = $data['taken_by'];

        $this->bloodRequestRepository->store($data);

        if(Auth::check())
            return redirect()->intended(route('blood-requests-list'))->with('success', 'Blood request added successfully!');
        else
            return redirect()->route('dashboard-phonebook')->with('success', 'Blood request added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function rescue($id)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $bloodDonors = $this->bloodDonorRepository->findBestMatch([
            'latitude'      => $bloodRequest->blood_bank->latitude,
            'longitude'     => $bloodRequest->blood_bank->longitude,
            'blood_type_id' => $bloodRequest->blood_type_id,
            'limit'         => 20
        ]);

        $bloodDonations = $bloodRequest->blood_donations;

        $callLogs = $bloodRequest->call_logs;

        return view('blood.requests.rescue', [
            'bloodRequest'   => $bloodRequest,
            'bloodDonors'    => $bloodDonors,
            'bloodDonations' => $bloodDonations,
            'callLogs'       => $callLogs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $bloodTypes = $this->bloodTypeRepository->getList();

        $bloodBanks = $this->contactRepository->getBloodBanksList();


        return view('blood.requests.edit', ['bloodRequest' => $bloodRequest, 'bloodTypes' => $bloodTypes, 'bloodBanks' => $bloodBanks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param SaveBloodRequestRequest $bloodRequestRequest
     * @return Response
     */
    public function update($id, SaveBloodRequestRequest $bloodRequestRequest)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $data = $bloodRequestRequest->all();

        $data['user_id'] = Auth::user()->id;

        $this->bloodRequestRepository->update($data, $bloodRequest);

        return redirect()->intended(route('blood-requests-list'))->with('success', $bloodRequest->patient_name . "'s blood request was updated successfully.");
    }


    /**
     * Set resource as complete
     *
     * @param  int $id
     * @return Response
     */
    public function setComplete($id)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $data['user_id'] = Auth::user()->id;

        $this->bloodRequestRepository->setComplete($data, $bloodRequest);

        return redirect()->back()->with('success', $bloodRequest->patient_name . "'s blood request was updated successfully.");
    }

    /**
     * Append new call log
     *
     * @param  int $id
     * @return Response
     */
    public function appendCallLog(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['blood_request_id'] = $request->blood_request_id;
        $data['donor_id'] = $request->donor_id;
        $data['call_type'] = $request->call_type;

        $this->bloodRequestRepository->appendCallLog($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $this->bloodRequestRepository->destroy($id);

        return redirect()->intended(route('blood-requests-list'))->with('success', $bloodRequest->patient_name . " blood request was deleted successfully.");
    }


}
