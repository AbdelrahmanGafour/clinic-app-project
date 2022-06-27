<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function countOfTotalAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','<>',3)
            ->count();
    }

    public function countOfTotalReservedAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',4)
            ->count();
    }

    public function countOfTotalMissedAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',2)
            ->count();
    }

    public function countOfTotalFinishedAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->count();
    }

    public function countOfTotalNewAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','=','New')
            ->count();
    }

    public function countOfTotalFollowUpAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','<>','New')
            ->count();
    }

    public function incomeToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','<>','New')
            ->sum('price');
    }

    public function countOfTotalAppointments($start_date,$end_date)
    {
        return Appointment::query()->where('date','>=',$start_date)
            ->where('date','<=',$end_date)->count();
    }

    public function countOfRegisteredPatients()
    {
        return Patient::query()->count();
    }

    public function countOfRegisteredDoctors()
    {
        return Doctor::query()->count();
    }

    public function patientsList()
    {
        return Patient::all();
    }
}
