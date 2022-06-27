@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2 class="fw-bolder">
                My Reserved Appointments

            </h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Reserved Appointments: {{ $appointments->count() }}</div>

                    <div class="card-body table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Visit Start Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Appointment Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $key=>$appointment)
                                    @if($appointment->patient_id != null)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ 'Dr. '.$appointment->doctor->user->first_name.' '.$appointment->doctor->user->middle_name.' '.$appointment->doctor->user->last_name}}</td>
                                        <td>{{date('l', strtotime($appointment->date))}}</td>
                                        <td>{{$appointment->date}}</td>
                                        <td>{{date('h:i A', strtotime($appointment->start_time))}}</td>
                                        <td>{{ $appointment->duration.' minutes'}}</td>
                                        <td>{{ $appointment->price.' EGP'}}</td>
                                        <td>{{ $appointment->status->status_name}}</td>
                                        <td class="">
                                            @if($appointment->status_id==4)
                                                @include('booking.modal')
                                            @elseif($appointment->status_id==5)
                                                <form action="{{route('patient.view.prescription')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-outline-success btn-sm w-100">View Prescription</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <td colspan="9">You have no appointments</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
