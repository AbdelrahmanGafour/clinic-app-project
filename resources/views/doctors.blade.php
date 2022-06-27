@extends('layouts.app')

@section('content')


    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors bg-light py-4">
        <div class="container">

            <div class="section-title">
                <h2>Doctors</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">
                @if (count($doctors) > 0)
                    @foreach ($doctors as $doctor)
                        <div class="col-lg-6 col-sm-12 h-100 g-2 p-1">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="@if($doctor->gender == 'male'){{url('img/doctors/doctors-1.jpg')}}@else{{url('img/doctors/doctors-2.jpg')}}@endif" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <h4>{{'Dr. '.$doctor->first_name.' '.$doctor->middle_name.' '.$doctor->last_name }}</h4>
                                    <span>{{$doctor->title_name}}</span>
                                    <p>{{ $doctor->specialty_name }}</p>
                                    <div class="social">
                                        {{--<p href="">@: <i class="fab fa-twitter"></i>{{ $doctor->email }}</p>
                                        <p href="">P: <i class="fab fa-facebook-f"></i>{{ $doctor->phone_number }}</p>
                                        <p href="">A: <i class="fab fa-instagram"></i>{{ $doctor->city }}</p>--}}


                                    </div>
                                </div>
                            </div>
                            <div class="container border-bottom rounded shadow-sm py-2 text-center">
                                <a href="{{route('patient.view.doctor.appointments', [$doctor->id])}}">
                                    <button type="button" class="btn btn-primary btn-sm">Appointments</button>
                                </a>
                                @include('admin.doctor.modal')
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </section><!-- End Doctors Section -->

@endsection

{{--

<a href="{{route('patient.view.doctor.appointments', [$doctor->id])}}">
    <button type="button" class="btn btn-primary">Appointments</button>
</a>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="doctorModal{{$doctor->id}}">
    Doctor Details
</button>--}}
