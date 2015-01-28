<?php namespace LRC\Http\Controllers\Blood;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
     * @param BloodRequestRepository $bloodRequestRepository
     * @param BloodTypeRepository $bloodTypeRepository
     * @param ContactRepository $contactRepository
     * @internal param Contact $contact
     */
    function __construct(BloodRequestRepository $bloodRequestRepository, BloodTypeRepository $bloodTypeRepository, ContactRepository $contactRepository)
    {

        $this->bloodRequestRepository = $bloodRequestRepository;
        $this->bloodTypeRepository    = $bloodTypeRepository;
        $this->contactRepository      = $contactRepository;
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
            $bloodRequests = $this->bloodRequestRepository->getPaginated(10);
        } else
        {
            $bloodRequests = $this->bloodRequestRepository->searchPaginated($searchQuery, 10);
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

        $data['user_id'] = Auth::user()->id;

        $this->bloodRequestRepository->store($data);

        return redirect()->intended(route('blood-requests-list'))->with('success', 'A new blood request was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

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


        return view('blood.requests.edit',['bloodRequest'=>$bloodRequest,'bloodTypes' => $bloodTypes, 'bloodBanks' => $bloodBanks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param SaveBloodRequestRequest $bloodRequestRequest
     * @return Response
     */
    public function update($id,SaveBloodRequestRequest $bloodRequestRequest)
    {
        $bloodRequest = $this->bloodRequestRepository->findOrFail($id);

        $data = $bloodRequestRequest->all();

        $data['user_id'] = Auth::user()->id;

        $this->bloodRequestRepository->update($data,$bloodRequest);

        return redirect()->intended(route('blood-requests-list'))->with('success', $bloodRequest->patient_name."'s blood request was added successfully.");
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

        return redirect()->intended(route('blood-requests-list'))->with('success', $bloodRequest->patient_name." blood request was deleted successfully.");
    }

}
