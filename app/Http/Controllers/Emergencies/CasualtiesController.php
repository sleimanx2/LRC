<?php namespace LRC\Http\Controllers\Emergencies;

use LRC\Data\Emergencies\CasualtiesRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CasualtiesController extends Controller {

    /**
     * @var CasualtiesRepository
     */
    private $casualtiesRepository;

    /**
     * @param CasualtiesRepository $casualtiesRepository
     */
    function __construct(CasualtiesRepository $casualtiesRepository)
    {
        $this->casualtiesRepository = $casualtiesRepository;
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
