<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_role = Auth::user()->role->role_name;
        switch ($user_role)
        {
            case 'patient':
                return view('home');

            case 'doctor':
                return view('admin.doctor.doctor-homepage');

            case 'admin':
                return $this->adminHome();

            case 'receptionist':
                return view('admin.layouts.receptionist-homepage');
        }
    }

    public function adminHome()
    {
        $dashboard = new ReportController();
        $figures = [
            'countOfTotalAppointmentsToday' => $dashboard->countOfTotalAppointmentsToday(),
            'countOfRegisteredPatients' => $dashboard->countOfRegisteredPatients(),
            'countOfRegisteredDoctors' => $dashboard->countOfRegisteredDoctors(),
            'countOfTotalReservedAppointmentsToday' => $dashboard->countOfTotalReservedAppointmentsToday(),
            'countOfTotalMissedAppointmentsToday' => $dashboard->countOfTotalMissedAppointmentsToday(),
            'countOfTotalFinishedAppointmentsToday' => $dashboard->countOfTotalFinishedAppointmentsToday(),
            'countOfTotalNewAppointmentsToday' => $dashboard->countOfTotalNewAppointmentsToday(),
            'countOfTotalFollowUpAppointmentsToday' => $dashboard->countOfTotalFollowUpAppointmentsToday(),
            'incomeToday' => $dashboard->incomeToday(),

        ];
        return view('admin.admin-homepage',compact('figures'));
    }
}
