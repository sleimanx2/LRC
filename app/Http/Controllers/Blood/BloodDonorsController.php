<?php namespace LRC\Http\Controllers\Blood;

use Illuminate\Support\Facades\Input;
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
     * @param BloodDonorRepository $bloodDonorRepository
     * @param BloodTypeRepository $bloodTypeRepository
     */
    function __construct(BloodDonorRepository $bloodDonorRepository , BloodTypeRepository $bloodTypeRepository)
    {
        $this->bloodDonorRepository = $bloodDonorRepository;
        $this->bloodTypeRepository = $bloodTypeRepository;
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

        return view('blood.donors.edit', ['bloodDonor'=>$bloodDonor,'bloodTypes'=>$bloodTypes]);
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

        $this->bloodDonorRepository->update($request->all(),$bloodDonor);

        return redirect()->intended(route('blood-donors-list'))->with('success', $bloodDonor->first_name.' '.$bloodDonor->last_name.' was added successfully updated');

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

        return redirect()->intended(route('blood-donors-list'))->with('success', $bloodDonor->first_name.' '.$bloodDonor->last_name.' was deleted successfully updated');


    }

}
