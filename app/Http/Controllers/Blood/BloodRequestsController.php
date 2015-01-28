<?php namespace LRC\Http\Controllers\Blood;

use LRC\Data\Blood\BloodRequestRepository;
use LRC\Data\Blood\BloodTypeRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
     * @param BloodRequestRepository $bloodRequestRepository
     * @param BloodTypeRepository $bloodTypeRepository
     */
    function __construct(BloodRequestRepository $bloodRequestRepository, BloodTypeRepository $bloodTypeRepository)
    {

        $this->bloodRequestRepository = $bloodRequestRepository;
        $this->bloodTypeRepository    = $bloodTypeRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bloodRequests = $this->bloodRequestRepository->getPaginated(10);

        $bloodTypes = $this->bloodTypeRepository->getList();

        return view('blood.requests.index', ['bloodRequests' => $bloodRequests,'bloodTypes'=>$bloodTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
