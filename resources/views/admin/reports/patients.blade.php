@extends('admin.layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Reports</h5>
                        <span>Patients Reports</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" class="breadcrumb-item active">Reports</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" class="breadcrumb-item active">Patients Reports</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="container">Patients List</h3>
                <h5 class="card-subtitle fw-bolder">Total Registered Patients: {{$patients->count()}}</h5>
            </div>
            <div class="card-body">
                <table class="table text-center align-middle">
                    <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $key => $patient)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$patient->user->first_name.' '.$patient->user->middle_name.' '.$patient->user->last_name}}</td>
                        <td>{{$patient->user->phone_number}}</td>
                        <td>{{$patient->user->email}}</td>
                        <td>{{$patient->user->city}}</td>
                        <td>
                            <button class="btn btn-primary btn-sm d-block w-100 my-1">Update Profile</button>
                            <button class="btn btn-success btn-sm d-block w-100 my-1">Reserve Appointment</button>
                            <button class="btn btn-dark btn-sm d-block w-100 my-1">Cancel Appointment</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
