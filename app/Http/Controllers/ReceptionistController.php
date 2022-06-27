<?php

namespace App\Http\Controllers;

use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ReceptionistController extends Controller
{
    public function addReceptionistForm()
    {
        return view('test view');
    }

    /**
     * Add Receptionist Admin Setter
     *
     */
    public function addReceptionist(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|max:100|alpha',
            'middleName' => 'required|max:100|alpha',
            'lastName' => 'required|max:100|alpha',
            'email' => 'required|unique:users|max:200|email:rfc,dns',
            'city' => 'required|max:100|alpha',
            'phone_number' => 'required|unique:users|digits_between:7,13|max:50',
            'gender' => 'required|boolean',
            'password' => 'required|confirmed|min:8',

            'specialty_id' => 'required|exists:specialties,id',
            'medical_title_id' => 'required|exists:titles,id',
            'bio' => 'required|min:50|max:2000',

        ]);

        if ($validator->fails()) {
            return redirect()->route('!!!!!!!!!!!!doctor.registration')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'first_name' => $request->firstName,
            'middle_name' => $request->middleName,
            'last_name' => $request->lastName,
            'city' => $request->city,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'nid' => $request->nid,
            'role_id' => 3,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $receptionist = Receptionist::create([
            'user_id' => $user->id,
        ]);
        dd($user,$receptionist);
    }
}
