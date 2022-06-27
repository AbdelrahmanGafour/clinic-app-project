<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class AppointmentController extends Controller
{
    public function create()
    {
        $appointment_type_list = DB::table('appointment_type')->get('appointment_name');
        return view('admin.appointment.create_new',compact('appointment_type_list'));
    }

    public function store(Request $request)
    {
        $firstTime = Carbon::parse($request->start_time);
        $secondTime = Carbon::parse($request->end_time);
        $variance = $firstTime->diffInMinutes($secondTime);

        $intervals_count = $variance / $request->duration;
        //dd($intervals_count);

        $visit_start_time = $firstTime;
        $validator = Validator::make($request->all(),[
            'date'=>'required|date',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'duration'=>'required|digits_between:1,3|min:1|max:180',
            'price'=>'required|min:0'
        ]);

        $doctor_id = DB::table('doctors')->select('id')->where('user_id','=',Auth::id())->value('id');

        if ($validator->fails()) {
            return redirect()->route('doctor.appointment.add')
                ->withErrors($validator)
                ->withInput();
        }

        $interval = 0;
        $successfully_added = 0;
        for ($interval; $interval < $intervals_count; $interval++)
        {
            if (Appointment::query()->where('date','=',$request->date)
                ->where('start_time','=',$visit_start_time)->count() == 0)
            {
                $appointment = Appointment::create([
                    'doctor_id' => $doctor_id,
                    'date'=>$request->date,
                    'start_time'=>$visit_start_time,
                    'duration'=>$request->duration,
                    'price'=>$request->price,
                ]);
                $successfully_added++;
            }

            $visit_start_time = $visit_start_time->addMinutes($request->duration);
        }

        if($successfully_added < $intervals_count)
        {
            return redirect()->route('appointment.add')
                ->with('failure','Appointment on '.$request->date.' at '.$visit_start_time.' already added before! '.$successfully_added.' appointments have been added till '.$visit_start_time->subMinutes($request->duration));
        }
        return redirect()->route('appointment.add')->with('success',$successfully_added.' appointments have been added!');
    }

    public function getAppointment($id)
    {
        return Appointment::where('id',$id)->first();
    }

    public function getPatientAppointments($id)
    {
        return Appointment::where('patient_id',$id)->get();
    }

    public function confirmAppointment($id)
    {
        $appointment = Appointment::find($id);
        $appointment->is_confirmed = 1;
        $appointment->save();
    }

    public function cancelAppointment(Request $request)
    {
        $appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();
        if (Auth::user()->patient->id != $appointment->patient_id)
        {
            return redirect()->back()
                ->with('failure','the appointment No. '.$appointment->id.' '.' is not reserved for you!');
        }
        $appointment->patient_id = null;
        $appointment->status_id = 1;/* Available Status*/
        $appointment->save();
        return redirect()->back()
            ->with('success','the appointment No. '.$appointment->id.' '.' is canceled successfully!');
    }

    public function doctorCancelAppointment(Request $request)
    {
        $appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();
        if (Auth::user()->doctor->id != $appointment->doctor_id)
        {
            return redirect()->back()
                ->with('failure','You aren\'t authorized to cancel appointment No. '.$appointment->id);
        }
        $appointment->status_id = 3; /*Canceled Status*/
        $appointment->save();
        return redirect()->back()
            ->with('success','the appointment No. '.$appointment->id.' '.' is canceled successfully!');
    }

    public function doctorEndAppointment(Request $request)
    {
        $appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();
        if (Auth::user()->doctor->id != $appointment->doctor_id)
        {
            return redirect()->back()
                ->with('failure','You aren\'t authorized to cancel appointment No. '.$appointment->id);
        }
        $appointment->status_id = 5; /*Canceled Status*/
        $appointment->save();
        return redirect()->back()
            ->with('success','the appointment No. '.$appointment->id.' '.' is finished successfully!');
    }

    public function modifyAppointmentForm(Request $request)
    {
        $old_appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();

        if (Auth::user()->patient->id != $old_appointment->patient_id)
        {
            return redirect()->back()
                ->with('failure','the appointment No. '.$old_appointment->id.' '.' is not reserved for you!');
        }

        $appointments =  Appointment::where('doctor_id',$old_appointment->doctor_id)
            ->where('date','>',Carbon::yesterday()->format('o-m-d'))
            ->where('start_time','>',Carbon::now('Africa/Cairo')->addMinutes(60)->format('H:i'))
            ->get();
        return view('booking.modify',compact('appointments','old_appointment'));

    }

    public function viewAppointment($id)
    {
        $appointment = Appointment::find($id);
        return view('booking.view',compact('appointment'));
    }

    public function doctorViewAppointment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'appointment_id'=>'exists:appointments,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('failure','This appointment is not reserved for you!');
        }

        $appointment = Appointment::find($request->appointment_id);
        return view('booking.doctor-view',compact('appointment'));
    }

    public function modifyAppointment(Request $request)
    {

        $old_appointment = Appointment::query()->where('id','=',$request->old_appointment_id)->get()->first();
        if ($old_appointment->patient_id != Auth::user()->patient->id)
        {
            return redirect()->back()
                ->with('failure','the appointment'.$old_appointment->date.' '.$old_appointment->start_time.' is already reserved for another patient, please select another appointment!');
        }
        $old_appointment->patient_id = null;
        $old_appointment->status_id = 1;/* Available Status*/
        $old_appointment->save();

        $new_appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();
        //dd($appointment->patient_id);
        if ($new_appointment->patient_id != null)
        {
            return redirect()->back()
                ->with('failure','the appointment'.$new_appointment->date.' '.$new_appointment->start_time.' is already reserved for another patient, please select another appointment!');
        }

        $new_appointment->patient_id = Auth::user()->patient->id;
        $new_appointment->status_id = 4; /*Reserved Status*/
        $new_appointment->save();
        return redirect()->route('patient.appointments')
            ->with('success','Your Appointment has been changed successfully, Appointment No. '.$new_appointment->id.' is reserved now! Make sure to show up at '.$new_appointment->date.' '.$new_appointment->start_time);
    }

    public function reserveAppointment(Request $request)
    {
        $appointment = Appointment::query()->where('id','=',$request->appointment_id)->get()->first();
        //dd($appointment->patient_id);
        if ($appointment->patient_id != null)
        {
            return redirect()->route('patient.view.doctor.appointments',$appointment->doctor_id)
                ->with('failure','the appointment'.$appointment->date.' '.$appointment->start_time.' is already reserved for another patient, please select another appointment!');
        }

        if($this->appointmentConflictValidation( Auth::user()->patient->id, $appointment->doctor_id) > 0)
        {
            return redirect()->route('patient.appointments')
                ->with('failure','You already have a reserved appointment with Dr. '.$appointment->doctor->user->first_name.' '.$appointment->doctor->user->middle_name.' '.$appointment->doctor->user->last_name.'.');
        }

        $appointment->patient_id = Auth::user()->patient->id;
        $appointment->status_id = 4; /*Reserved Status*/
        $appointment->save();
        return redirect()->route('patient.appointments')
            ->with('success','Appointment No. '.$appointment->id.' is reserved successfully! Make sure to show up at '.$appointment->date.' '.$appointment->start_time);
    }

    public function appointmentConflictValidation($patient_id,$doctor_id)
    {
        $conflict = Appointment::query()->where('patient_id','=',$patient_id)
            ->where('status_id','=',4)
            ->where('doctor_id','=',$doctor_id)
            ->get();
        return $conflict->count();
    }

    public function listDoctorAppointments($doctor_id)
    {
        $appointments =  Appointment::where('doctor_id',$doctor_id)
            ->where('date','>=',Carbon::today('Africa/Cairo')->format('o-m-d'))
            ->where('status_id','=',1)
            ->where('start_time','>',Carbon::now('Africa/Cairo')->addMinutes(60)->format('H:i'))
            ->orderBy('date','asc')
            ->orderBy('start_time','asc')
            ->get();
        $doctor = Doctor::where('id',$doctor_id)->get();
        return view('booking.index',compact('appointments','doctor'));
    }

    public function patientAppointments($patient_id)
    {
        return Appointment::where('patient_id',$patient_id)->get();
    }
}
