<?php

namespace LRC\Http\Controllers;

use LRC\Data\Contacts\Contact;
use LRC\Data\Users\User;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    /**
     * Gets first aiders in JSON format.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFirstAidersJSON(Request $request)
    {
        $first_aiders = User::with('roles')->get();

        $arr["data"] = array();

        foreach($first_aiders as $first_aider) {
         	array_push($arr["data"], array(
        		"DT_RowClass" => "phonebook-row dial-item-btn",
        		"DT_RowData" => [
	                "dial" => json_encode($first_aider->phone_numbers),
	                "dial-name" => $first_aider->full_name
	            ],

	            $first_aider->is_ex,
	            $first_aider->is_rm,
	            $first_aider->is_amb,
	            "<b>" . $first_aider->last_name . "</b>",
	            "<b>" . $first_aider->first_name . "</b>",
	            $first_aider->nickname,
	            $first_aider->promo,
	            $first_aider->location,
	            ($first_aider->is_rm ? '<span class="label label-primary m-r-xs" title="Regional Manager">RM</span>' : '') . 
	            ($first_aider->is_amb ? '<span class="label label-success m-r-xs" title="Ambulance Driver"><i class="fa fa-car"></i></span>' : '') . 
	            ($first_aider->is_ami ? '<span class="label label-default" title="Ami du Centre"><i class="fa fa-users"></i></span>' : '')
        	));
        }

        return $arr;
    }

    /**
     * Gets medical centers in JSON format.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMedicalCentersJSON(Request $request)
    {
        $medical_centers = Contact::whereHas('category', function ($query) {
            $query->where('parent_category', 'medical-centers');
        })->orderBy('sector')->get();

        $arr["data"] = array();

        foreach($medical_centers as $medical_center) {
         	array_push($arr["data"], array(
        		"DT_RowClass" => "phonebook-row dial-item-btn",
        		"DT_RowData" => [
	                "dial" => json_encode($medical_center->phone_numbers),
	                "dial-name" => $medical_center->name
	            ],

	            $medical_center->filter_term,
	            "<b>" . $medical_center->sector . "</b>",
	            "<b>" . $medical_center->nickname . "</b>",
	            $medical_center->name
        	));
        }

        return $arr;
    }

    /**
     * Gets lrc centers in JSON format.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLrcCentersJSON(Request $request)
    {
        $lrc_centers = Contact::whereHas('category', function ($query) {
            $query->where('parent_category', 'lrc-centers');
        })->orderBy('sector')->get();

        $arr["data"] = array();

        foreach($lrc_centers as $lrc_center) {
         	array_push($arr["data"], array(
        		"DT_RowClass" => "phonebook-row dial-item-btn",
        		"DT_RowData" => [
	                "dial" => json_encode($lrc_center->phone_numbers),
	                "dial-name" => $lrc_center->sector . " (" . $lrc_center->name . ")"
	            ],

	            "<b>" . $lrc_center->sector . "</b>",
	            "<b>" . $lrc_center->name . "</b>",
	            $lrc_center->ambulances
        	));
        }

        return $arr;
    }

    /**
     * Gets organizations in JSON format.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrganizationsJSON(Request $request)
    {
        $organizations = Contact::whereHas('category', function ($query) {
            $query->where('parent_category', 'organizations');
        })->orderBy('name')->get();

        $arr["data"] = array();

        foreach($organizations as $organization) {
         	array_push($arr["data"], array(
        		"DT_RowClass" => "phonebook-row dial-item-btn",
        		"DT_RowData" => [
	                "dial" => json_encode($organization->phone_numbers),
	                "dial-name" => $organization->name
	            ],

	            $organization->filter_term,
	            "<b>" . $organization->name . "</b>",
	            $organization->location
        	));
        }

        return $arr;
    }

    /**
     * Dial Number API.
     *
     * @return \Illuminate\Http\Response
     */
    public function dialNumberAPI(Request $request)
    {
		$url = "http://{$request->ip_address}/cgi-bin/api-make_call?phonenumber={$request->phone_number}&account=0&password=admin";
		return json_encode(file_get_contents($url));
    }
}
