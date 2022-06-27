<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function create()
    {
        return view('prescription.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_id' => 'required',

            'symptoms' => 'required',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $record = Record::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_id' => $request->appointment_id,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'note' => $request->note,
            ]);

        return redirect()->back()->with('success','Prescription added successfully!');

    }

    public function getPatientRecords($id)
    {
        return Record::query()->where('patient_id','=',$id)->get();
    }

    public function viewPrescription(Request $request)
    {
        $prescriptions = Record::query()->where('appointment_id','=',$request->appointment_id)->get();
        return view('my-prescription',compact('prescriptions'));
    }
}
