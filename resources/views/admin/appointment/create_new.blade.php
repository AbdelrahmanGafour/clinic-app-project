@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctor Appointments</h5>
                        <span>Choose your available time for appointments</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Available Visits</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if (Session::has('message'))
                <div class="alert bg-success alert-success text-white text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            {{-- Error Message --}}
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>

            @endforeach
            {{-- Form --}}
            <form action="{{ route('appointment.add') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Add Appointment</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="col-lg-12">
                                <label for="date">Date</label>
                                <input id="date" type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                       value="{{ old('date') }}">
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col-lg-6">
                                <label for="start_time">Start Time</label>
                                <input id="start_time" type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                                       value="{{ old('start_time') }}">
                            </div>

                            <div class="col-lg-6">
                                <label for="end_time">End Time</label>
                                <input id="end_time" type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                                       value="{{ old('end_time') }}">
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col-lg-6">
                                <label for="start_time">Visit Duration<span class="h6 text-muted"> in minutes</span></label>
                                <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration"
                                       data-toggle="duration" data-target="#duration" name="duration" value="{{ old('duration') }}">
                            </div>

                            <div class="col-lg-6">
                                <label for="start_time">Visit Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                       data-toggle="price" data-target="#price" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>

        <style type="text/css">
            input[type="checkbox"] {
                zoom: 1.1;

            }

            body {
                font-size: 18px;
            }

        </style>
    </div>
@endsection
