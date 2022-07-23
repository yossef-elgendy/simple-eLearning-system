@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="alertUpdateUser" class="row justify-content-center mt-1 mb-1" style="display: none;">

        </div>
        <div class="row justify-content-center">
            <div class="col col-md-8">

                <div id="showCard" class="card bg-second rounded">
                    <div class="card-header bg-first rounded-top text-white">
                        My Profile
                    </div>
                    <div class="card-body bg-second">
                        <h5 id="newName" class="card-title">{{strtoupper($user->name)}}</h5>
                        <div class="card-text">
                            <div class="row mb-2 mt-2">
                                <div id="newEmail" class="col col-md 8">
                                    <strong>Email:</strong> {{$user->email}}
                                </div>

                                <div id="newMobile" class="col col-md 8">
                                    <strong>Mobile:</strong> {{$user->mobile}}
                                </div>
                            </div>

                            <div class="row mb-2 mt-2">
                                <div class="col col-md 8">
                                    <strong>Role:</strong> {{$user->role}}
                                </div>

                                <div id="newDateOfBirth" class="col col-md 8">
                                    <strong>Date Of Birth:</strong> {{$user->dateOfBirth}}
                                </div>
                            </div>

                            <div class="row mb-2 mt-2">
                                <div id="newAddress" class="col col-md-8">
                                    <strong>Address:</strong> {{isset($user->address)?$user->address:"No Address"}}
                                </div>
                            </div>

                        </div>
                        <div class="row p-3">
                            <button id="edit" class="btn btn-primary-new"> Edit </button>
                        </div>

                    </div>
                </div>



                <div id="editCard" class="card bg-second rounded" style="display: none;" >
                    <div class="card-header bg-first rounded-top text-white">
                        Edit Your Profile
                    </div>
                    <div class="card-body bg-second">
                        <form method="POST" action="{{route('profile.update',$user->id)}}" autocomplete="off" >
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>


                                    <span class="invalid-feedback" role="alert">
                                        <strong id="nameE"></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control"  name="email" value="{{ $user->email }}" required>


                                    <span class="invalid-feedback" role="alert">
                                        <strong id="emailE"></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="{{ $user->mobile }}" required>


                                    <span class="invalid-feedback" role="alert">
                                        <strong id="mobileE"></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
{{--                                    <textarea form="test" id="address" class="form-control" name="address">{{ $user->address }}</textarea>--}}
                                    <input id="address" type="text" class="form-control" name="address"  value="{{ $user->address }}"/>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dateOfBirth" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="dateOfBirth" type="date" class="form-control" name="dateOfBirth" value="{{ $user->dateOfBirth }}" required>


                                    <span class="invalid-feedback" role="alert">
                                        <strong id="dobE"></strong>
                                    </span>

                                </div>
                            </div>


                            <br>
                            <hr>
                            <br>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" required>


                                    <span class="invalid-feedback" role="alert">
                                        <strong id="old_pwE"></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" required>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="new_pwE"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirm_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Your New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirm_new_password" type="password" class="form-control" name="new_password" required>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="confirm_new_pwE"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button value="{{$user->id}}" id="Update" type="button" class="btn btn-primary-new">
                                        {{ __('Update') }}
                                    </button>

                                    <button id="cancelEdit" type="button" class="btn btn-cancel">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
