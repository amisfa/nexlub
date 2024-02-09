@extends('layouts.app', ['page' => __('User Management'), 'pageSlug' => 'user-management'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">User Management</div>
                    <livewire:admin-view.user-management-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

