@extends('layouts.app', ['page' => __('Withdraw'), 'pageSlug' => 'withdraw'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Withdraw</div>
                    <form method="post" action="{{route('make-withdraw')}}" onsubmit="return validateForm();">
                        <div class="card-body">
                            @csrf
                            <div class="flex flex-wrap">
                                <div class="form-group w-full md:w-1/2 p-1">
                                    <label for="amount">USD Amount to
                                        Withdraw</label>
                                    <div>
                                        <input type="number" min=0 step="any" class="form-control withdraw-amount"
                                               name="amount"
                                               required
                                               autofocus>
                                    </div>
                                </div>
                                <div class="form-group w-full md:w-1/2 p-1">
                                    <label for="Currency">Currency</label>
                                    <select class="form-control" id="withdraw-currency" name="currency" required>
                                        <option value="" class="comboBox"></option>
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency['currency']}}"
                                                    class="comboBox"
                                                    min_amount="{{$currency['min_amount']}}">
                                                {{$currency['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row justify-end">
                                <button type="submit" class="btn ">Withdraw</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-header">Withdraw History</div>
                    <div class="p-3">
                        <div class="border" style="border-color: #2b3553!important;">
                            <livewire:user-withdraw-view/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function validateForm() {
            amount = parseFloat($('.withdraw-amount').val())
            minAmount = parseFloat($('#withdraw-currency').find(":selected").attr('min_amount'))
            if (amount < minAmount) {
                alert('The amount is less than the limit, Currency limit is: ' + minAmount + " USD")
                return false
            } else {
                return true
            }
        }
    </script>
@endpush
