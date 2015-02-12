<?php namespace LRC\Http\Controllers\Blood;

use Illuminate\Support\Facades\Auth;
use LRC\Data\Blood\BloodDonationRepository;
use Illuminate\Support\Facades\Input;
use LRC\Data\Blood\BloodDonor;
use LRC\Data\Blood\BloodDonorRepository;
use LRC\Data\Blood\BloodTypeRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Http\Requests\SaveBloodDonorRequest;

class BloodDonorsController extends Controller {

    /**
     * @var BloodDonorRepository
     */
    private $bloodDonorRepository;
    /**
     * @var BloodTypeRepository
     */
    private $bloodTypeRepository;
    /**
     * @var BloodDonationRepository
     */
    private $bloodDonationRepository;

    /**
     * @param BloodDonorRepository $bloodDonorRepository
     * @param BloodTypeRepository $bloodTypeRepository
     * @param BloodDonationRepository $bloodDonationRepository
     */
    function __construct(BloodDonorRepository $bloodDonorRepository, BloodTypeRepository $bloodTypeRepository, BloodDonationRepository $bloodDonationRepository)
    {
        $this->bloodDonorRepository    = $bloodDonorRepository;
        $this->bloodTypeRepository     = $bloodTypeRepository;
        $this->bloodDonationRepository = $bloodDonationRepository;
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
            $bloodDonors = $this->bloodDonorRepository->getPaginated(10);
        } else
        {
            $bloodDonors = $this->bloodDonorRepository->searchPaginated($searchQuery, 10);
        }

        return view('blood.donors.index', ['bloodDonors' => $bloodDonors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $bloodTypes = $this->bloodTypeRepository->getList();

        return view('blood.donors.create', ['bloodTypes' => $bloodTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveBloodDonorRequest $request
     * @return Response
     */
    public function store(SaveBloodDonorRequest $request)
    {
        $this->bloodDonorRepository->create($request->all());

        return redirect()->intended(route('blood-donors-list'))->with('success', 'A blood donor was added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $bloodDonor = $this->bloodDonorRepository->findOrFail($id);

        $bloodTypes = $this->bloodTypeRepository->getList();

        return view('blood.donors.edit', ['bloodDonor' => $bloodDonor, 'bloodTypes' => $bloodTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param SaveBloodDonorRequest $request
     * @return Response
     */
    public function update($id, SaveBloodDonorRequest $request)
    {
        $bloodDonor = $this->bloodDonorRepository->findOrFail($id);

        $this->bloodDonorRepository->update($request->all(), $bloodDonor);

        return redirect()->intended(route('blood-donors-list'))->with('success', $bloodDonor->first_name . ' ' . $bloodDonor->last_name . ' was added successfully updated');

    }


    /**
     * Triggered when the donor accept to donate for a certain patient.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function willDonate(Request $request)
    {
        $this->validate($request, [
            'donor_id'         => 'required',
            'blood_request_id' => 'required',
            'will_donate_on'   => 'required',
            'donation_type'    => 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $bloodDonor = $this->bloodDonorRepository->findOrFail($data['donor_id']);

        $this->bloodDonorRepository->postponeDuty(strtotime('+3 months'), $bloodDonor);

        $this->bloodDonationRepository->create($data);

        return redirect()->back()->with('success', $bloodDonor->first_name . ' ' . $bloodDonor->last_name . ' was successfully added as a potential donor.');

    }


    /**
     * Triggered when the donor refuse to donate for a certain patient.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wontDonate(Request $request)
    {
        $this->validate($request, [
            'bloodDonorId'   => 'required',
            'bloodRequestId' => 'required',
            'delay'          => 'required',
        ]);

        $data = $request->all();

        $bloodDonor = $this->bloodDonorRepository->findOrFail($data['bloodDonorId']);

        $this->bloodDonorRepository->postponeDuty($data['delay'], $bloodDonor);

        return redirect()->back()->with('success', $bloodDonor->first_name . ' ' . $bloodDonor->last_name . ' was successfully removed from duty till ' . date('Y-m-d', $data['delay']));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $bloodDonor = $this->bloodDonorRepository->findOrFail($id);

        $this->bloodDonorRepository->destroy($id);

        return redirect()->intended(route('blood-donors-list'))->with('success', $bloodDonor->first_name . ' ' . $bloodDonor->last_name . ' was deleted successfully updated');


    }

}
