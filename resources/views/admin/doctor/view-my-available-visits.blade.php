@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h3 class="fw-bolder">
            Your Scheduled Appointments
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
                            <th scope="col">Appointment Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{date('l', strtotime($appointment->date))}}</td>
                            <td>{{$appointment->date}}</td>
                            <td>{{date('h:i A', strtotime($appointment->start_time))}}</td>
                            <td>{{ $appointment->duration.' minutes'}}</td>
                            <td>{{$appointment->status->status_name}}</td>

                            <td>
                                @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'doctor.view.myUpcomingVisits')
                                <form action="{{route('doctor.cancel.appointment')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <td colspan="7">{{'No Appointments'}}</td>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
