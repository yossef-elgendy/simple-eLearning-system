@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-8">

            </div>
        </div>
        <div class="row justify-content-center">



            @forelse($courses as $course)
                <div class="col col-md-4 h-100">
                    <div class="card element bg-second mb-2">
                        <div class="card-header bg-first text-white rounded-top">
                            {{$course->specName}}
                        </div>
                        <div class="card-body bg-second rounded">
                            <h5 class="card-title">{{$course->courseName}}</h5>
                            <small class="text-muted">Duration : {{$course->duration}} Hours</small>
                            <p class="card-text">Content : {{$course->content}}</p>
                            <a href="{{route('courses.show',$course->id)}}" class="btn btn-primary-new"><i class="fas fa-eye"></i> Show</a>
                            <button type="submit" data-toggle="modal" data-target="#delete{{$course->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>

                            <div class="modal fade" id="delete{{$course->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-second">
                                        <div class="modal-header bg-first text-white">
                                            <h5 class="modal-title">{{$course->courseName}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white btn btn-danger" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this course ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                                            <button type="button" value="{{$course->id}}"  data-dismiss="modal" class="btn btn-danger delete" ><i class="fas fa-trash-alt"></i> Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route('courses.edit',$course->id)}}" class="btn btn-primary edit"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </div>


                </div>
                @empty

            @endforelse
        </div>
    </div>


@endsection
