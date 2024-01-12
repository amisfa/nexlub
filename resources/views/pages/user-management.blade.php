@extends('layouts.app', ['page' => __('User Management'), 'pageSlug' => 'userManagement'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">User Management</div>
                    <livewire:user-management-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

