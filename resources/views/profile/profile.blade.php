{{--@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h5 class="title">{{ __('Profile') }}</h5>--}}
{{--                </div>--}}
{{--                <form method="post" action="{{ route('signup-form') }}" onsubmit="return registerValidation();">--}}
{{--                    <div class="card-body">--}}
{{--                        @csrf--}}
{{--                        @method('Post')--}}

{{--                        @include('alerts.success')--}}

{{--                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Name') }}</label>--}}
{{--                            <input type="text" name="name" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('UserName') }}" value="{{ old('username', auth()->user()->username) }}">--}}
{{--                            @include('alerts.feedback', ['field' => 'name'])--}}
{{--                        </div>--}}

{{--                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Email address') }}</label>--}}
{{--                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">--}}
{{--                            @include('alerts.feedback', ['field' => 'email'])--}}
{{--                        </div>--}}

{{--                        <div class="form-group{{ $errors->has('wallet_n0') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Name') }}</label>--}}
{{--                            <div type="wallet_no" name="wallet_no" class="form-control{{ $errors->has('wallet_no') ? ' is-invalid' : '' }}">--}}
{{--                                {{ old('username', auth()->user()->username) }}                            </div>--}}
{{--                            @include('alerts.feedback', ['field' => 'email'])--}}
{{--                        </div>--}}
{{--                        <div class="form-group{{ $errors->has('wallet_n0') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Email') }}</label>--}}
{{--                            <div type="wallet_no" name="wallet_no" class="form-control{{ $errors->has('wallet_no') ? ' is-invalid' : '' }}">--}}
{{--                                {{ old('email', auth()->user()->email) }}--}}
{{--                            </div>--}}
{{--                            @include('alerts.feedback', ['field' => 'email'])--}}
{{--                        </div>--}}
{{--                        <div class="form-group{{ $errors->has('wallet_n0') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Wallet number') }}</label>--}}
{{--                            <div type="wallet_no" name="wallet_no" class="form-control{{ $errors->has('wallet_no') ? ' is-invalid' : '' }}">--}}
{{--                                {{ old('wallet_no', auth()->user()->wallet_no) }}--}}
{{--                            </div>--}}
{{--                            @include('alerts.feedback', ['field' => 'email'])--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="{{route('editprofile')}}">--}}
{{--                        <button class="btn btn-fill btn-primary">{{ __('Edit') }}</button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h5 class="title">{{ __('Password') }}</h5>--}}
{{--                </div>--}}
{{--                <form method="post" action="#" autocomplete="off">--}}
{{--                    <div class="card-body">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}

{{--                        @include('alerts.success', ['key' => 'password_status'])--}}

{{--                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('Current Password') }}</label>--}}
{{--                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>--}}
{{--                            @include('alerts.feedback', ['field' => 'old_password'])--}}
{{--                        </div>--}}

{{--                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">--}}
{{--                            <label>{{ __('New Password') }}</label>--}}
{{--                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>--}}
{{--                            @include('alerts.feedback', ['field' => 'password'])--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Confirm New Password') }}</label>--}}
{{--                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--            <div class="card card-user">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="card-text">--}}
{{--                    <div class="author">--}}
{{--                        <div class="block block-one"></div>--}}
{{--                        <div class="block block-two"></div>--}}
{{--                        <div class="block block-three"></div>--}}
{{--                        <div class="block block-four"></div>--}}
{{--                        <a href="#">--}}
{{--                            <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">--}}
{{--                            <h5 class="title">{{ auth()->user()->name }}</h5>--}}
{{--                        </a>--}}
{{--                        <p class="description">--}}
{{--                            {{ old('username', auth()->user()->username) }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    </p>--}}
{{--                    <div class="card-description">--}}
{{--                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <div class="button-container">--}}
{{--                        <button class="btn btn-icon btn-round btn-facebook">--}}
{{--                            <i class="fab fa-facebook"></i>--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-icon btn-round btn-twitter">--}}
{{--                            <i class="fab fa-twitter"></i>--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-icon btn-round btn-google">--}}
{{--                            <i class="fab fa-google-plus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layouts.app', ['page' => __('Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3 overflow-auto">
                    <div class="card-header"></div>
                    <livewire:example-detail-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

