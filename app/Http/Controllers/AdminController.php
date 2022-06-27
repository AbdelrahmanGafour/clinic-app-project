<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientsReport()
    {
        $patientsList = new ReportController();
        $patients = $patientsList->patientsList();
        return view('admin.reports.patients',compact('patients'));
    }

}
