@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5">
        <div class="jumbotron">
            <h3 class="fw-bolder">
                Available Appointments of Dr.
                {{$doctor[0]->user->first_name.' '.$doctor[0]->user->middle_name.' '.$doctor[0]->user->last_name}}
            </h3>
        </div>
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

                                @forelse($appointments as $appointment)
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
                                            <a href="{{route('patient.view.appointment', $appointment->id)}}" class="btn btn-outline-success btn-sm">
                                                Reserve
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <td colspan="7">{{'No Appointments for Dr. '.$doctor[0]->user->first_name.' '.$doctor[0]->user->middle_name.' '.$doctor[0]->user->last_name}}</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
