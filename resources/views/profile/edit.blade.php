@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{route('edit-user-details')}}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        @include('alerts.success')
                        <div class="form-group">
                            <label>{{ __('Email address') }}</label>
                            <input type="email" name="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Email address') }}"
                                   value="{{ old('email', $user->email) }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Wallet') }}</label>
                            <input name="wallet_no"
                                   class="form-control{{ $errors->has('wallet_no') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Wallet') }}"
                                   value="{{ old('wallet_no', $user->wallet_no) }}">
                            @include('alerts.feedback', ['field' => 'wallet_no'])
                        </div>
                        <label>{{ __('Avatar') }}</label>
                        <div style="overflow-x: scroll;border: solid 2px;min-height: 90px" class="beauty-scroll">
                            <div style="width:100%;display: flex;">
                                @for ($i = 1; $i <= 64; $i++)
                                    <div class="avatar-selection">
                                        <input type="radio" name="avatar" value="{{$i}}" id="radio{{$i}}"
                                               required=""
                                               {!! $user->avatar === $i ? "checked" : "" !!} style="display: none">
                                        <label for="radio{{$i}}">
                                            <img src="{{ asset('avatars').'/'. $i }}.png" class="grayscale"
                                                 style="display: inline-block; height: 64px"
                                                 alt="{{ __('Profile Photo') }}">
                                        </label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>
                <form method="post" action="{{route('change-user-password')}}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        @include('alerts.success', ['key' => 'password_status'])
                        <div class="form-group">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password"
                                   class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Confirm New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password_confirmation'])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
