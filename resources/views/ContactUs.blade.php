@extends('layouts.app')

@section('content')

    <div class="container contact-form rounded">
        <div class="contact-image text-center justify-content-center">
            <i class="fas fa-envelope-open fa-10x display-3 rounded-circle"></i>
        </div>
        <form method="post" action="{{route('contactMail')}}">
            @csrf
            <h3>Ask a question Or report a problem</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{$errors->has('name')?'is-invalid':''}}" placeholder="Your Name *" value="" />
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('name')}}</strong>
                            </div>
                        @endif

                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" placeholder="Your Email *" value="{{old('email')}}" />
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('email')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control {{$errors->has('subject')?'is-invalid':''}}" placeholder="subject *" value="{{old('subject')}}" />
                        @if($errors->has('subject'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('subject')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" value="{{old('phone')}}" />

                    </div>
                    <div class="form-group">
                        <input type="submit"  class="btn btn-sm btn-primary-new" value="Send Message"  style="border-radius: 20px"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="msg" class="form-control {{$errors->has('msg')?'is-invalid':''}}" placeholder="Your Message *" style="width: 100%; height: 150px;">{{old('msg')}}</textarea>
                        @if($errors->has('msg'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('msg')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
