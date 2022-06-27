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
                <h3 class="container">Query Input</h3>
            </div>
            <div class="card-body">
                <form>

                </form>
            </div>
        </div>
    </div>
@endsection
