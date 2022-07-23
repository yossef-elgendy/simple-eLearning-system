@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-8">

            </div>
        </div>
        <div class="row justify-content-center">


            <div class="col col-md-8 justify-content-center h-100">
                @forelse($courses as $course)


                    <div class="card element bg-second mb-2 course">
                        <div class="card-header bg-first text-white rounded-top">
                            {{$course->specification->name}}
                        </div>
                        <div class="card-body bg-second rounded">
                            <h5 class="card-title">{{$course->name}}</h5>
                            <small class="text-muted">Duration : {{$course->duration}} Hours</small>
                            <p class="card-text">Content : {{$course->content}}</p>
                            <a href="{{route('enroll.show',$course->id)}}" class="btn btn-primary-new"><i class="fas fa-eye"></i> Show</a>
                            @if(count($course->students()->where('user_id',auth()->user()->id)->get()))
                                <button data-toggle="modal" data-target="#dropout{{$course->id}}" class="btn btn-cancel"><i class="fas fa-outdent"></i> Drop Out</button>

                                <form  action="{{route('enroll.enroll',$course->id)}}" method="post">
                                @csrf

                                <!-- Modal -->
                                    <div class="modal fade" id="dropout{{$course->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content rounded">
                                                <div class="modal-header bg-first text-white">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                                        <span class="btn btn-danger" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-second">
                                                    Are you sure you want to drop out from {{$course->name}}?
                                                </div>
                                                <div class="modal-footer bg-second">
                                                    <button type="button" class="btn btn-cancel" data-dismiss="modal">No</button>
                                                    <button  value="{{$course->id}}" type="button" data-dismiss="modal" class="btn btn-accept dropout">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            @endif



                        </div>
                    </div>



                @empty


                    <div class="card bg-second rounded">
                        <div class="card-body text-center">
                            <h5 class="display-5 card-title ">You Didn't Enrolled Into Any Course Yet  !!</h5>
                        </div>
                    </div>

                @endforelse
            </div>
        </div>
    </div>


@endsection
