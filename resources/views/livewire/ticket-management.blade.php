@extends('layouts.app', ['page' => __('Ticket Management'), 'pageSlug' => 'ticket-management'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="flex justify-between items-center px-2">
                        <div class="card-header">Ticket Management</div>
                        {{--                        <button class="btn" onclick="Livewire.emit('openModal', 'ticket-upsert')">Create</button>--}}
                    </div>
                    <br/>
                    <div class="p-3">
                        <div class="border" style="border-color: #2b3553!important;">
                            <livewire:admin-view.ticket-management-view/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
