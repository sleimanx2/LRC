<?php namespace LRC\Http\Controllers\Emergencies;

use LRC\Data\Emergencies\EmergencyRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EmergenciesController extends Controller {

    /**
     * @var EmergencyRepository
     */
    private $emergencyRepository;

    /**
     * @param EmergencyRepository $emergencyRepository
     */
    function __construct(EmergencyRepository $emergencyRepository)
    {
        $this->emergencyRepository = $emergencyRepository;
    }

    public function index()
    {
        $emergencies =  $this->emergencyRepository->getPaginated(20);

        return view('emergencies.index',['emergencies'=>$emergencies]);
    }

    /**
     * Create a new emergency
     */
    public function create()
    {

    }

    /**
     *
     */
    public function store()
    {

    }

    /**
     *
     */
    public function edit()
    {

    }

    /**
     *
     */
    public function update()
    {

    }

    /**
     *
     */
    public function end()
    {

    }

    /**
     *
     */
    public function destroy()
    {

    }

    /**
     *
     */
    public function parentsCalled()
    {

    }

}
