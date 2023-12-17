@extends('layouts.app', ['page' => __('Deposit'), 'pageSlug' => 'Deposit'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Balance</div>
                    <div class="card-body">
                        <form method="post" action="{{route('pay')}}" onsubmit="return validateForm();">
                            @csrf
                            <div class="form-group">
                                <label for="Amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="price_amount"
                                       placeholder="Enter input" required>
                            </div>
                            <div class="form-group">
                                <label for="Currency">Currency</label>
                                <select class="form-control" id="currency" name="price_currency" required>
                                    <option value="" class="comboBox"></option>
                                    <option value="USD" class="comboBox">USD</option>
                                    <option value="IRR" class="comboBox">IRR</option>
                                    <option value="TRL" class="comboBox">TRL</option>
                                    <option value="EUR" class="comboBox">EUR</option>
                                    <option value="AED" class="comboBox">AED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Currency">Pay Currency</label>
                                <select class="form-control" id="pay-currency" name="pay_currency" required>
                                    <option value="" class="comboBox"></option>
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency['currency']}}"
                                                min_amount="{{$currency['min_amount']}}"
                                                max_amount="{{$currency['max_amount']}}"
                                                class="comboBox">
                                            {{strtoupper($currency['currency'])}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-around" style="padding:15px;padding-top:0px;">
                                <div class="min-column text-danger"></div>
                                <div class="max-column text-success"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(window).on('pageshow', function(){
            manipulateLimits()
        });

        $('#pay-currency').change(function () {
            manipulateLimits()
        });
        function manipulateLimits() {
            minAmount = $('#pay-currency').find(":selected").attr('min_amount')
            maxAmount = $('#pay-currency').find(":selected").attr('max_amount')
            if (minAmount || maxAmount) {
                $('.min-column').html(`Min: ` + minAmount)
                $('.max-column').html(`Max: ` + maxAmount)
            }
        }
        function validateForm() {
            minAmount = $('#pay-currency').find(":selected").attr('min_amount')
            maxAmount = $('#pay-currency').find(":selected").attr('max_amount')
            amount = $('#amount').val()
            if (amount < minAmount) {
                alert('The amount is less than the limit')
                return false
            } else if (amount > maxAmount) {
                alert('The amount is more than the limit')
                return false
            } else return true
        }
    </script>
@endpush
