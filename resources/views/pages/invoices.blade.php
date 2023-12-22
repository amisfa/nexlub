@extends('layouts.app', ['page' => __('Invoices'), 'pageSlug' => 'invoices'])

@section('content')
    <livewire:invoices-table-view/>

@endsection
