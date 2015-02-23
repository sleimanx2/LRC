<?php namespace LRC\Http\Controllers;

use LRC\Data\Blood\BloodDonorRepository;
use LRC\Data\Blood\BloodTypeRepository;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    /**
     * @var BloodTypeRepository
     */
    private $bloodTypeRepository;
    /**
     * @var BloodDonorRepository
     */
    private $bloodDonorRepository;

    /**
     * Create a new controller instance.
     * @param BloodTypeRepository $bloodTypeRepository
     * @param BloodDonorRepository $bloodDonorRepository
     */

	public function __construct(BloodTypeRepository $bloodTypeRepository,BloodDonorRepository $bloodDonorRepository)
	{
        $this->bloodTypeRepository = $bloodTypeRepository;
        $this->bloodDonorRepository = $bloodDonorRepository;
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
        $bloodTypes = $this->bloodTypeRepository->getAll();
        $totalBloodDonors = $this->bloodDonorRepository->getTotal();
		return view('home',compact('bloodTypes','totalBloodDonors'));
	}

}
