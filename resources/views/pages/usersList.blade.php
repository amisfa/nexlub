@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'usersList'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">Users</div>
                    <livewire:users-list-table-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

