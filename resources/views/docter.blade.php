@extends('layouts.app')

@section('content')
<div id="doctors" class="parallax section db" data-stellar-background-ratio="0.4" style="background:#fff;" data-scroll-id="doctors" tabindex="-1">
    <div class="container">

     <div class="heading">
           <span class="icon-logo"><img src="images/icon-logo.png" alt="#"></span>
           <h2>The Specialist Clinic</h2>
        </div>

        <div class="row dev-list text-center">
            @forelse (\App\Models\Employee::where('position', 'doctor')->get() as $doctor)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                <div class="widget clearfix">
                    <img src="{{ $doctor->image ? asset('storage/' . $doctor->image) : asset('images/doctor_01.jpg') }}" alt="" class="img-responsive img-rounded">
                    <div class="widget-title">
                        <h3>{{  $doctor->name }}</h3>
                        <small>{{  $doctor->qualification }}</small>
                    </div>
                    <!-- end title -->
                    <p>Hello guys, I am Soren from Sirbistana. I am senior art director and founder of Violetta.</p>

                    <div class="footer-social">
                        <a href="#" class="btn grd1"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn grd1"><i class="fa fa-github"></i></a>
                        <a href="#" class="btn grd1"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn grd1"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div><!--widget -->
            </div><!-- end col -->
            @empty
            <p>No doctors available.</p>
            @endforelse
        </div><!-- end row -->
    </div><!-- end container -->
  </div>

@endsection
