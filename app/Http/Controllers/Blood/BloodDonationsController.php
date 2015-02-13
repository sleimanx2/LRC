<?php


namespace LRC\Http\Controllers\Blood;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LRC\Data\Blood\BloodDonationRepository;
use LRC\Data\Blood\BloodDonorRepository;
use LRC\Http\Controllers\Controller;

class BloodDonationsController extends Controller{

    protected $bloodDonorRepository;
    protected $bloodDonationRepository;

    function __construct(BloodDonationRepository $bloodDonationRepository, BloodDonorRepository $bloodDonorRepository )
    {
        $this->bloodDonorRepository    = $bloodDonorRepository;
        $this->bloodDonationRepository = $bloodDonationRepository;
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


}