@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My prescriptions: {{ $prescriptions->count() }}</div>
                    <div class="card-body table-responsive-md">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Symptoms</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Specialization</th>
                                    <th scope="col">Prescribed by</th>
                                    <th scope="col">Prescribed at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{$prescription->symptoms}}</td>
                                    <td>{{$prescription->treatment}}</td>
                                    <td>{{$prescription->note}}</td>
                                    <td>{{$prescription->doctor->specialty->specialty_name}}</td>
                                    <td>{{'Dr. '.$prescription->doctor->user->first_name.' '.$prescription->doctor->user->middle_name.' '.$prescription->doctor->user->last_name}}</td>
                                    <td>{{$prescription->appointment->created_at}}</td>
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
