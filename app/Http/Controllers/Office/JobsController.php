<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\UISP;

class JobsController extends Controller
{
    /**
     * Instance of UISP
     */
    private UISP $api;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->api = new UISP();
    }

    public function index()
    {
        $jobs = $this->api->get('scheduling/jobs', [
            'assignedUserId' => Auth::user()->isp_id
        ]);

        dd($jobs);
    }

    public function allJobs()
    {
        dd($this->api->get('scheduling/jobs', []));
    }
}
