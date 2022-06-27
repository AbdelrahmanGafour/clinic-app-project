@extends('layouts.app')

@section('content')
    <!-- //JUMBOTRON -->
    <div class="jumbotron-fluid home-jumbotron text-center py-5">
        <!-- //JUMBOTRON - Container -->
        <div class="container align-middle py-3 home-jumbotron-container rounded">
            <div class="col-12">
                <!-- //JUMBOTRON - Title -->
                <h1 class="jumbotronTitle text-primary fw-bolder" id="jumbotronTitle">

                    Welcome {{auth()->user()->first_name}}
                </h1>
                <!-- JUMBOTRON - Title// -->


                <!-- //JUMBOTRON - Body -->
                <div class="jumbotronBody" id="jumbotronBody">
                    <p>
                        We try to make your medical appointments smooth as possible.
                    </p>
                </div>
                <!-- JUMBOTRON - Body// -->

                <!-- //JUMBOTRON - Footer -->
                <footer class="jumbotronFooter" id="jumbotronFooter">
                    <a class="btn btn-primary w-50 mt-1" href="{{route('patient.view.doctors')}}  " role="button">
                        View Our Doctors
                    </a>
                    <a class="btn btn-primary w-50 mt-1" href="{{route('patient.appointments')}}  " role="button">
                        View Your Appointments
                    </a>
                    @guest
                        <div class="mt-2">
                            <a href="{{ url('/register') }}"> <button class="btn btn-primary w-25">Register as Patient</button></a>
                            <a href="{{ url('/login') }}"><button class="btn btn-success w-25">Login</button></a>
                        </div>
                    @endguest
                </footer>
                <!-- JUMBOTRON - Footer// -->
            </div>
        </div>
    </div>
    <!-- JUMBOTRON// -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
        </div>

        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.229093760288!2d31.208330014593184!3d30.030284726197397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846d0b038b591%3A0x20d985c61b122570!2sFaculty%20of%20Computers%20and%20Artificial%20Intelligence%2C%20Cairo%20University!5e0!3m2!1sen!2seg!4v1655324095113!5m2!1sen!2seg" width="100%" height="350" style="border:0;" allowfullscreen></iframe>
        </div>

        <div class="container">
            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="fas fa-map-marker-alt"></i>
                            <h4>Location:</h4>
                            <p>Address Street, Maadi, Cairo</p>
                        </div>

                        <div class="email">
                            <i class="fas fa-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="fas fa-mobile"></i>
                            <h4>Call:</h4>
                            <p>+02 245678912</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form action="f" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

@endsection
