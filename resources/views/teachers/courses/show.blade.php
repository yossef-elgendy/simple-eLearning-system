@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">


            <div class="col col-md-10">
                <div class="card element bg-second mb-2 course">
                    <div class="card-header bg-first text-white rounded-top">
                        {{$course->specification->name}}
                    </div>
                    <div class="card-body bg-second rounded">
                        <div class="row mt-2">
                            <div class="col col-md-8">
                                <h5 class="card-title">{{$course->name}} </h5>
                            </div>
                            <div class="col col-md-4">
                                <small class="text-muted">Posted at: {{$course->created_at}}</small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col col-md-8">
                                <small class="text-muted">Duration : {{$course->duration}} Hours</small>
                            </div>
                            <div class="col col-md-4 ">
                                <small class="text-muted">Updated at: {{$course->updated_at}}</small>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col col-md-12">
                                <p class="card-text">Content : {{$course->content}}</p>
                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col col-md-12 h4">Students:</div>
                        </div>


                            @for($i = 0; $i < count($course->students) ; $i++ )
                                <div class="row justify-content-center mt-2">
                                    <div class="col col-md-3">{{$course->students[$i]->name}}</div>
                                    <div class="col col-md-3">{{$course->students[$i]->email}}</div>
                                    <div class="col col-md-3">{{$course->students[$i]->mobile}}</div>
                                    <div class="col col-md-3">{{isset($course->students[$i]->address)?$course->students[$i]->address:"No Address"}}</div>
                                </div>
                            @endfor

                        <div class="row  mt-4">
                            <div class="col col-md-7 h4">Feedbacks:</div>
                        </div>
                        @foreach($students as $student)
                            <div id="feedbacks" class="container mt-2">
                                @if($student->pivot->feedBack != null)

                                    <div class="row mb-2 comment ">
                                        <div class="card px-4 bg-first text-white" style="border-radius: 20px;">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <h5 class="card-title ">Name: {{$student->name}}</h5>
                                                </div>
                                                <div class="row">
                                                    <p class="card-text pl-5">{{$student->pivot->feedBack}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
