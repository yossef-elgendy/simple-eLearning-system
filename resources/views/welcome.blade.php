@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mb-4">
            <div class="row text-center">
                <a class="navbar-brand text-white ">
                    <span class="h1"> <i class="fas fa-users"></i> E-Learning</span>
                </a>
            </div>
    </div>

    <div class="row justify-content-center">
        <div class="row justify-content-center">
            <h5 class="text-white text-uppercase">Main Idea:</h5>
            <p class="text-white text-center col-md-5" style="font-size: 16px">
                Here we care about student's health and well being so we made this platform to make it easy
                for you to study from home and be safe from Covid-19 virus.
                It will also help you save a lot of time because we made our courses' content as useful and easy as possible
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card-group ">
            <div class="card mr-1 bg-first text-white">
                <img src="{{asset('Card1.jpg')}}" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title">For All Ages</h5>
                    <p class="card-text">We have courses that may fit all the ages of our students.</p>
                </div>
            </div>
            <div class="card mr-1 bg-first text-white">
                <img src="{{asset('Card2.jpg')}}" class="card-img-top" alt="..." style="height: 250px; width: auto; position: center;">
                <div class="card-body">
                    <h5 class="card-title">Our Teachers Are Well Equipped</h5>
                    <p class="card-text">They are prepared for every possibility that may happen so we provided them with the suitable equipment they need.</p>

                </div>
            </div>
            <div class="card mr-1 bg-first text-white">
                <img src="{{asset('Card3.jpg')}}" class="card-img-top" alt="..." style="height: 250px; width: auto; position: center;">
                <div class="card-body">
                    <h5 class="card-title">Creative Thinking</h5>
                    <p class="card-text">Our teaching techniques depend on students participation so our students gain the skill of creative thinking</p>
                </div>
            </div>
        </div>

    </div>






    <div class="row justify-content-center">

    </div>
</div>


@endsection
