<?php namespace LRC\Http\Controllers\Blood;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use LRC\Data\Blood\BloodDonor;
use LRC\Data\Blood\BloodDonorRepository;
use LRC\Data\Blood\BloodTypeRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;
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

    function __construct(BloodDonorRepository $bloodDonorRepository, BloodTypeRepository $bloodTypeRepository )
    {
        $this->bloodDonorRepository    = $bloodDonorRepository;
        $this->bloodTypeRepository     = $bloodTypeRepository;
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
            $bloodDonors = $this->bloodDonorRepository->getPaginated(15);
        } else
        {
            $bloodDonors = $this->bloodDonorRepository->searchPaginated($searchQuery, 15);
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

    /**
     * Returns list of donors in JSON format for search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $donors_columns = [DB::raw("concat(first_name, ' ', last_name)"), 'phone_primary', 'phone_secondary'];

        $term = str_replace(' ', '.*', trim($request->term));

        $donors = BloodDonor::where(function ($q) use ($donors_columns, $term) {
            foreach ($donors_columns as $index => $column) {
                $q->orWhere($column, 'regexp', "{$term}");
            }
        })->get();

        $result = array();

        foreach($donors as $donor) {
            $item["id"] = $donor->id;
            $item["gender"] = $donor->gender;
            $item["golden"] = $donor->golden_donor;
            $item["name"] = $donor->first_name . " " . $donor->last_name;
            $item["age"] = floor((time() - strtotime($donor->birthday))/31556926);
            $item["phone"] = $donor->phone_numbers;
            $item["phone_primary"] = $donor->phone_primary;
            $item["phone_secondary"] = $donor->phone_secondary;
            $item["location"] = $donor->location;
            $item["notes"] = nl2br($donor->note);

            array_push($result, $item);
        }

        return json_encode($result);
    }

}
