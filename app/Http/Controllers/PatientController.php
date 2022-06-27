<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:100|alpha',
            'middle_name' => 'required|max:100|alpha',
            'last_name' => 'required|max:100|alpha',
            'email' => 'required|unique:users|max:200',
            'city' => 'required|max:100|alpha',
            'phone_number' => 'required|unique:users|digits_between:7,13|max:50',
            'nid' => 'required|unique:users|digits:14',
            'gender' => 'required|in:male,female',
            'password' => 'required|confirmed|min:8',
            'address' => 'required|max:800',
            'date_of_birth' => 'required|min:4|max:2000',
            'note' => 'required|min:4|max:2000',

        ]);

        if ($validator->fails()) {
            return redirect()->route('patient.registration')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'city' => $request->city,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'nid' => $request->nid,
            'role_id' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'note' => $request->note,
        ]);
        return redirect('/');
    }


    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit',compact('user'));
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'email' => 'nullable|unique:users|max:200',
            'city' => 'nullable|max:100|alpha',
            'phone_number' => 'nullable|unique:users|digits_between:7,13|max:50',
            'password' => 'nullable|confirmed|min:8',
            'address' => 'nullable|max:800',
            'note' => 'nullable|min:4|max:2000',

        ]);

        if ($validator->fails()) {
            return redirect()->route('patient.profile.edit')
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::find(Auth::user()->id);

        $user_update = 0;
        isset($request->email)? $user->email = $request->email : $user_update++;
        isset($request->city)? $user->city = $request->city : $user_update++;
        isset($request->phone_number)? $user->phone_number= $request->phone_number : $user_update++;
        isset($request->password)? $user->password= Hash::make($request->password) : $user_update++;
        $user_update > 0 ? $user->save() : $user_update++;

        $patient_update = 0;
        $patient = Patient::find(Auth::user()->patient->id);
        isset($request->address)? $patient->address = $request->address : $patient_update++;
        isset($request->note)? $patient->note = $request->note : $patient_update++;
        $patient_update > 0 ? $patient->save() : $patient_update++;


        return redirect()->route('patient.profile.edit')
            ->with('success','your data is updated successfully');
    }


    public function getPatient($id)
    {
        return Patient::where('id',$id)->first();
    }

    public function viewDoctors()
    {
        $doctors_list = new DoctorController;
        $doctors = $doctors_list->getDoctorsList();
        return view('doctors',compact('doctors'));
    }

/*    public function viewDoctorAppointment($id)
    {
        $appointments_list = new AppointmentController;
        $appointments = $appointments_list->listDoctorAppointments($id);
        //dd($appointments);
        return view('booking.index',compact('appointments'));
    }*/

    public function myAppointments()
    {
        $myAppointments = new AppointmentController;
        $appointments = $myAppointments->patientAppointments(Auth::user()->patient->id);
        return view('my-appointments',compact('appointments'));
    }
}


