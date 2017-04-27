<?php

namespace LRC\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		return view('dashboard.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showORDashboard()
    {
		return view('dashboard.or');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showPhonebookDashboard()
    {
		return view('dashboard.phonebook');
    }
}
