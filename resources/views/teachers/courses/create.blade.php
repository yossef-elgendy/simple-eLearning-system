@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center ">
            <div class="col col-md-8 ">
                <div class="card bg-second">

                    <div class="card-header bg-first text-white rounded-top h3">Add Course</div>

                    <div class="card-body bg-second rounded ">
                        <form method="post" autocomplete="off" action="{{route('courses.store')}}">
                           @csrf
                            <div class="form-group row">
                                <label class="col col-md-4" for="name">Name</label>
                                <div class="col col-md-8">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Course Name" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif

                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="specification_id" class="col col-md-4">Specification</label>
                                <div id="specID" class="col col-md-4">
                                    <select name="specification_id" class="form-control{{$errors->has('specification_id')?' is-invalid':''}}" id="specification_id" required>
                                        <option selected disabled hidden>Choose A Specification</option>
                                        @foreach($specifications as $specification)
                                        <option value="{{$specification->id}}" {{old('specification_id')==$specification->id?'selected':''}}>{{$specification->name}}</option>
                                        @endforeach
                                        <option value="other">Other..</option>
                                    </select>
                                    @if ($errors->has('specification_id'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('specification_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div id="specName" class="col col-md-4" style="display: {{$errors->has('specName')?'block':'none'}}"  >
                                    <input type="text" name="specName" value="{{old('specName')}}" placeholder="Another Specification" class="form-control {{$errors->has('specName')?' is-invalid':''}}"  >
                                        @if($errors->has('specName'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('specName') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="duration" class="col col-md-4">Duration</label>
                                <div class="col col-md-4">
                                    <input type="number" name="duration" value="{{old('duration')}}" placeholder="Course's Duration" class="form-control" id="duration" >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="content" class="col col-md-4">Content Info</label>
                                <div class="col col-md-8">
                                    <textarea name="content" class="form-control{{$errors->has('content')?' is-invalid':''}}" id="content" rows="3">{{old('content')}}</textarea>
                                </div>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col col-md-4">
                                    <button type="submit" class="btn btn-primary-new"><i class="fas fa-plus"></i> ADD</button>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
