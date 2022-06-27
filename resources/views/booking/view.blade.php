@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Confirm This Appointment Reservation</h3></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Doctor</th>
                                    <td>{{$appointment->doctor->user->first_name.' '.$appointment->doctor->user->middle_name.' '.$appointment->doctor->user->last_name}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Day</th>
                                    <td>{{date('l', strtotime($appointment->date))}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Date</th>
                                    <td>{{$appointment->date}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Time</th>
                                    <td>{{date('h:i A', strtotime($appointment->start_time))}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Duration</th>
                                    <td>{{$appointment->duration}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Price</th>
                                    <td>{{$appointment->price.' EGP'}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" scope="row">Status</th>
                                    <td>{{$appointment->patient_id == null? 'Free':'Reserved'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if (Auth::check())
                            @if(Auth::user()->role->role_name == 'patient')
                                @if($appointment->patient_id == null)
                                <form action="{{route('patient.reserve.appointment')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                        <button type="submit" class="btn btn-primary">Reserve Appointment</button>
                                </form>
                                @else
                                    <a class="btn btn-danger" href="{{route('patient.view.doctor.appointments',$appointment->doctor_id)}}">Book Another Appointment</a>
                                @endif
                            @endif
                        @else
                            <p>Please login to make an appointment</p>
                            <a class="btn btn-success" href="/register">Register</a>
                            <a class="btn btn-primary" href="/login">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
