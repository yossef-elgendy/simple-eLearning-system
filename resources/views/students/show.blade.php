@extends('layouts.app')

@section('content')

    <div  class="container">
        <div id="alertSTATUS" class="row justify-content-center" >
            @if(session()->has('status'))
                <div  class="col col-md-7" >
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Feedback is deleted.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

            @endif
        </div>
    </div>

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


                                @if(!count($course->students()->where('user_id',auth()->user()->id)->get()))
                                        <div class="row mt-2">
                                            <div class="col col-md-12">
                                                <button data-toggle="modal" id="buttonEnroll{{$course->id}}" data-target="#enrollModal{{$course->id}}" class="btn btn-accept"><i class="fas fa-user-plus"></i> Enroll</button>

                                                <form  action="{{route('enroll.enroll',$course->id)}}" method="post">
                                                @csrf

                                                <!-- Modal -->
                                                    <div class="modal fade" id="enrollModal{{$course->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content rounded">
                                                                <div class="modal-header bg-first text-white">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                                                        <span class="btn btn-danger" aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-second">
                                                                    Are you sure you want to enroll into {{$course->name}}?
                                                                </div>
                                                                <div class="modal-footer bg-second">
                                                                    <button type="button" class="btn btn-cancel" data-dismiss="modal">No</button>
                                                                    <button value="{{$course->id}}" data-dismiss="modal" type="button" class="btn btn-accept enroll">Yes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mt-2">
                                        <div class="col col-md-12">
                                                <button data-toggle="modal" id="buttonDropout{{$course->id}}" data-target="#dropout{{$course->id}}" class="btn btn-cancel"><i class="fas fa-outdent"></i> Drop Out</button>

                                                <form  action="{{route('enroll.dropout',$course->id)}}" method="post">
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
                                        </div>
                                    </div>

                            @if($feedback[0]->pivot->feedBack == null)
                                <div id="reply" class="row  justify-content-center mt-2">
                                    <div class="col col-md-12">
                                        <label for="feedback" class="h4 mb-1">Write A Feedback:</label>
                                        <textarea id="feedback" name="feedBack" class="form-control form-group " >

                                        </textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="ReplyButton" value="{{$course->id}}" class="btn btn-lg btn-primary-new col col-md-12">Add Feedback</button>
                                    </div>
                                </div>
                            @endif
                        @endif


                            <div  class="row   mt-4">
                                <div class="col col-md-5 h4">
                                    Feedbacks:
                                </div>
                            </div>
                            <div id="feedbacks" class="container feedbacks">
                            @foreach($students as $student)

                                    @if($student->pivot->feedBack != null)

                                            <div class="row mb-2 comment ">
                                                <div class="card px-3 bg-first text-white" style="border-radius: 20px;">
                                                    <div class="card-body">
                                                        <div class="row ">
                                                                <h6 class="card-title">Name:{{$student->name}}</h6>
                                                       </div>
                                                        <div class="row">
                                                            <p class="card-text pl-5">{{$student->pivot->feedBack}}</p>
                                                        </div>

                                                        <div class="row mt-1">
                                                            @if($student->pivot->user_id == auth()->user()->id)
                                                                <form method="post" action="{{route('enroll.deleteFeedBack',$student->pivot->course_id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button  type="submit" class="btn btn-cancel">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    @endif

                            @endforeach
                            </div>










                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
