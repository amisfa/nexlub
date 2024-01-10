@extends('layouts.app', ['page' => __('Withdraw Management'), 'pageSlug' => 'withdrawManagement'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">Withdraw Management</div>
                    <livewire:withdraw-management-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

