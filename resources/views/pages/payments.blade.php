@extends('layouts.app', ['page' => __('Payments'), 'pageSlug' => 'payments'])

@section('content')
    <livewire:payments-table-view />
@endsection
