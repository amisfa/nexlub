@extends('layouts.app', ['page' => __('Payments'), 'pageSlug' => 'payments'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3 overflow-auto">
                    <div class="card-header">Payments</div>
                    <livewire:payments-table-view/>
                </div>
            </div>
        </div>
    </div>
@endsection

