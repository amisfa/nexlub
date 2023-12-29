@extends('layouts.app', ['page' => __('Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3 overflow-auto">
                    <div class="card-header"></div>
                    <livewire:user-profile-view :model="auth()->id()"/>
                </div>
            </div>
        </div>
    </div>
@endsection

