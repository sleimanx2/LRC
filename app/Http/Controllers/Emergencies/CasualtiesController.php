<?php namespace LRC\Http\Controllers\Emergencies;

use LRC\Data\Emergencies\CasualtiesRepository;
use LRC\Data\Emergencies\EmergencyRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CasualtiesController extends Controller {

    /**
     * @var CasualtiesRepository
     */
    private $casualtiesRepository;
    /**
     * @var EmergencyRepository
     */
    private $emergencyRepository;

    /**
     * @param CasualtiesRepository $casualtiesRepository
     * @param EmergencyRepository $emergencyRepository
     */
    function __construct(CasualtiesRepository $casualtiesRepository,EmergencyRepository $emergencyRepository)
    {
        $this->casualtiesRepository = $casualtiesRepository;
        $this->emergencyRepository = $emergencyRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store(Request $request)
	{
		$this->validate($request,[
            'name'=>'required|min:2',
            'emergency_id'=>'required|exists:emergencies,id'
        ]);


        $this->casualtiesRepository->store($request->all());

        $this->emergencyRepository->updateCasualtiesStatistics($request->input('emergency_id'));

        return redirect()->back()->with('success','A casualty was successfully added.');
	}


	public function update($id , Request $request)
	{
        $this->validate($request,[
            'name'=>'required|min:2',
        ]);

		$casualty  = $this->casualtiesRepository->findOrFail($id);

        $this->casualtiesRepository->update($request->all(),$casualty);

        return redirect()->back()->with('success',$casualty->name."'s".' record was successfully updated.');
    }


}
