@extends('layouts.app', ['page' => __('Withdraw'), 'pageSlug' => 'withdraw'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Withdraw Funds</div>
                    <form method="post" action="{{route('make-withdraw')}}">
                        <div class="card-body">
                            @csrf
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">Amount to
                                    Withdraw</label>
                                <div class="col-md-6">
                                    <input type="number" min=0 step="any" class="form-control" name="amount" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Withdraw</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="p-3">
                        <div class="border border-gray-200">
                            <livewire:user-withdraw-view/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
