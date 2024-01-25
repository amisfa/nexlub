@extends('layouts.app', ['page' => __('Tickets'), 'pageSlug' => 'tickets'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tickets</div>
                    <livewire:user-tickets-view/>
                </div>
            </div>
        </div>
    </div>
@endsection
