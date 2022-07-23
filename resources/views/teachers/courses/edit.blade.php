@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center ">
            <div class="col col-md-8 ">
                <div class="card bg-second">

                    <div class="card-header bg-first text-white rounded-top h3">Edit Course</div>

                    <div class="card-body bg-second rounded ">
                        <form method="post" autocomplete="off" action="{{route('courses.update',$course->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col col-md-4" for="name">Name</label>
                                <div class="col col-md-8">
                                    <input type="text" name="name" value="{{$course->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Course Name" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif

                                </div>

                            </div>

                            <input type="hidden" name="quantifier" id="keyQ" value="0">

                            <div class="form-group row">
                                <label for="spec" class="col col-md-4">Specification</label>
                                <div id="SelectSpec" class="col col-md-4">
                                    <select name="specification_id" class="form-control{{$errors->has('specification_id')?' is-invalid':''}}" id="spec" required>
                                        <option selected disabled hidden>Choose A Specification</option>
                                        @foreach($specifications as $specification)
                                            <option value="{{$specification->id}}" {{$course->specification->id == $specification->id?"selected":""}}>{{$specification->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('specification_id'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('specification_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="EditQ" class="col col-md-4">
                                    <button type="button" id="EditSpec" class="btn-accept btn"><i class="fas fa-edit"></i> Edit Specification</button>
                                </div>

                                <div id="SPEC" class="col col-md-4" style="display: none;">
                                    <input type="text" id="specNameUp" class="form-control {{$errors->has('specName')?'is-invalid':''}}" name="specName" value="{{$course->specification->name}}">
                                    @if ($errors->has('specName'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('specName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="Cancel" class="col col-md-4" style="display: none;">
                                    <button type="button" id="CancelEdit" class="btn-cancel btn"><i class="fas fa-times"></i> Cancel Edit</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col col-md-4">Duration</label>
                                <div class="col col-md-4">
                                    <input type="number" name="duration" value="{{$course->duration}}" placeholder="Course's Duration" class="form-control" id="duration" >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="content" class="col col-md-4">Content Info</label>
                                <div class="col col-md-8">
                                    <textarea name="content" class="form-control{{$errors->has('content')?' is-invalid':''}}" id="content" rows="3">{{$course->content}}</textarea>
                                </div>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col col-md-4">
                                    <input type="submit" value="Update" class="btn btn-primary-new">
                                    <a href="{{route('courses.index')}}" class="btn btn-cancel"><i class="fas fa-times"></i> Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
