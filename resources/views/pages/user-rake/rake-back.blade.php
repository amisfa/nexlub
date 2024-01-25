@extends('layouts.app', ['page' => __('Rake Back'), 'pageSlug' => 'rakeBack'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rake Back</div>
                    <livewire:rake-back-view/>
                </div>
            </div>
        </div>
    </div>
@endsection
