@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Patient Details</h3></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Patient Name</th>
                                <td>{{$patientDetails->user->first_name.' '.$patientDetails->user->middle_name.' '.$patientDetails->user->last_name}}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Appointment Date</th>
                                <td>{{$patientAppointmentDetails->date}}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Appointment Time</th>
                                <td>{{date('h:i A', strtotime($patientAppointmentDetails->start_time))}}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Age</th>
                                <td>{{date_diff(date_create($patientDetails->date_of_birth) ,date_create())->format('%r%Y years, %m months')}}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Gender</th>
                                <td>{{$patientDetails->user->gender}}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" scope="row">Further Notes</th>
                                <td>{{$patientDetails->note}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if (Auth::check())
                            @if(Auth::user()->role->role_name == 'doctor')
                                @if($patientAppointmentDetails->doctor_id == Auth::user()->doctor->id)
                                    @if($patientAppointmentDetails->status_id != 5)
                                        <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                                data-target="#presciptionModal">
                                            Prescribe
                                        </button>
                                        <form action="{{route('doctor.end.appointment')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="appointment_id" value="{{ $patientAppointmentDetails->id }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 mt-2">Finish Visit</button>
                                        </form>
                                    @endif


                                   {{-- <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                            data-target="#previousVisitsModal">
                                        Previous Visits
                                    </button>--}}
                                    @include('prescription.form')
{{--
                                    @include('booking.previous-visits-modal')
--}}

                                @endif
                            @endif
                        @else
                            <p>Please login to update the appointment</p>
                            <a class="btn btn-primary" href="/login">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Patient History</h3></div>

                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Symptoms</th>
                                    <th scope="col">Diagnosis</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Specialization</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col">Visit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($patientRecords as $patientRecord)
                                <tr>
                                    <td>{{$patientRecord->symptoms}}</td>
                                    <td>{{$patientRecord->diagnosis}}</td>
                                    <td>{{$patientRecord->treatment}}</td>
                                    <td>{{$patientRecord->note}}</td>
                                    <td>{{$patientRecord->doctor->specialty->specialty_name}}</td>
                                    <td>{{'Dr. '.$patientRecord->doctor->user->first_name.' '.$patientRecord->doctor->user->middle_name.' '.$patientRecord->doctor->user->last_name}}</td>
                                    <td>{{$patientRecord->appointment->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
