@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="carouselExampleInterval" class="carousel slide bg-dark" data-ride="carousel" data-interval="1500">

                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleInterval" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleInterval" data-slide-to="1"></li>
                    <li data-target="#carouselExampleInterval" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active" >
                        <img src="{{asset('item1.jpg')}}" class="d-block w-100" alt="..." style="opacity: 0.2">
                        <div class="carousel-caption">
                            <h5>Learn From Home</h5>
                            <p>In our website we guarantee you the easiest  and the safest way to learn and it is from home</p>
                        </div>
                    </div>
                    <div class="carousel-item" >
                        <img src="{{asset('item2.jpg')}}" class="d-block w-100" alt="..." style="opacity: 0.2">
                        <div class="carousel-caption ">
                            <h5>Recorded Sessions</h5>
                            <p>We offer you recorded sessions so you could listen to them anytime anywhere.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('item3.jpg')}}" class="d-block w-100" alt="..." style="opacity: 0.2">
                        <div class="carousel-caption ">
                            <h5>Best Instructors</h5>
                            <p>We have the best instructors that guarantee  an easy way to learn and a wonderful experience.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
