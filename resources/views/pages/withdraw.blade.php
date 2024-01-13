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
                            <div class="flex flex-wrap">
                                <div class="form-group w-full md:w-1/2 p-1">
                                    <label for="amount">Amount to
                                        Withdraw</label>
                                    <div>
                                        <input type="number" min=0 step="any" class="form-control" name="amount"
                                               required
                                               autofocus>
                                    </div>
                                </div>
                                <div class="form-group w-full md:w-1/2 p-1">
                                    <label for="Currency">Currency</label>
                                    <select class="form-control" name="currency" required>
                                        <option value="" class="comboBox"></option>
                                        @foreach($currencies as $currency)
                                            <option  value="{{$currency['currency']}}"
                                                    class="comboBox">{{$currency['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row justify-end">
                                <button type="submit" class="btn btn-primary">Withdraw</button>
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
