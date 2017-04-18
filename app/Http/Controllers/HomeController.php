<?php namespace LRC\Http\Controllers;

use LRC\Data\Blood\BloodDonorRepository;
use LRC\Data\Blood\BloodRequestRepository;
use LRC\Data\Blood\BloodTypeRepository;
use LRC\Data\Emergencies\EmergencyRepository;

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
     * @var EmergencyRepository
     */
    private $emergencyRepository;
    /**
     * @var BloodRequestRepository
     */
    private $bloodRequestRepository;

    /**
     * Create a new controller instance.
     * @param BloodTypeRepository $bloodTypeRepository
     * @param BloodDonorRepository $bloodDonorRepository
     * @param EmergencyRepository $emergencyRepository
     * @param BloodRequestRepository $bloodRequestRepository
     */

	public function __construct(BloodTypeRepository $bloodTypeRepository,BloodDonorRepository $bloodDonorRepository,EmergencyRepository $emergencyRepository,BloodRequestRepository $bloodRequestRepository)
	{
        $this->bloodTypeRepository = $bloodTypeRepository;
        $this->bloodDonorRepository = $bloodDonorRepository;
        $this->emergencyRepository = $emergencyRepository;
        $this->bloodRequestRepository = $bloodRequestRepository;
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
        $remainingBloodRequests = $this->bloodRequestRepository->findRemaining();
        $remainingUnconfirmedBloodRequests = $this->bloodRequestRepository->findRemainingForConfirmation();

		return view('home',compact('bloodTypes','totalBloodDonors','emergencyReports','remainingBloodRequests','remainingUnconfirmedBloodRequests','activeEmergencies'));
	}

}
