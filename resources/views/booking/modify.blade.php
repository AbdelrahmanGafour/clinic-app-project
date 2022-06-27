@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5">
        <div class="jumbotron ">
            <h4 class="">
                Modify your Appointment and select from Available Appointments of
                <strong> Dr.
                {{ $old_appointment->doctor->user->first_name.' '.$old_appointment->doctor->user->middle_name.' '.$old_appointment->doctor->user->last_name}}
                </strong>
            </h4>
        </div>
        <div class="card mb-4 border-danger">
            <div class="card-header bg-danger text-white fw-bold">Previous Reserved Appointment</div>
            {{--
                ****************************************************
                    Previous Appointments Tabl
                ****************************************************
            --}}
            <div class="card-body table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Appointment Reference ID</th>
                        <th scope="col">Day</th>
                        <th scope="col">Date</th>
                        <th scope="col">Visit Start Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $old_appointment->id }}</td>
                            <td>{{date('l', strtotime($old_appointment->date))}}</td>
                            <td>{{$old_appointment->date}}</td>
                            <td>{{date('h:i A', strtotime($old_appointment->start_time))}}</td>
                            <td>{{ $old_appointment->duration.' minutes'}}</td>

                            <td>{{--$appointment->created_at->format('m-d-yy')--}}
                                {{ $old_appointment->price.' EGP'}}
                            </td>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
{{--
    ****************************************************
        Available Appointments Table
    ****************************************************
--}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Available appointments: {{ $appointments->count() }}</div>

                    <div class="card-body table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Appointment Reference ID</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Visit Start Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($appointments as $key=>$appointment)
                                    @if($appointment->patient_id == null)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{date('l', strtotime($appointment->date))}}</td>
                                        <td>{{$appointment->date}}</td>
                                        <td>{{date('h:i A', strtotime($appointment->start_time))}}</td>
                                        <td>{{ $appointment->duration.' minutes'}}</td>

                                        <td>{{--$appointment->created_at->format('m-d-yy')--}}
                                            {{ $appointment->price.' EGP'}}
                                        </td>
                                        <td>
                                            @include('booking.modify-modal')
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <td>You have no any appointments</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
