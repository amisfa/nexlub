@extends('layouts.app', ['page' => __('Invoices'), 'pageSlug' => 'invoices'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Balance</div>
                    <div class="card-body">
                        <form method="post" action="{{route('set-invoice')}}" onsubmit="return validateForm();">
                            @csrf
                            <div class="form-group">
                                <label for="Amount">USD Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="price_amount"
                                       placeholder="$100" required>
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
                            <div class="d-flex flex-column justify-content-around"
                                 style="padding:15px;padding-top:0px;">
                                <div class="min-column text-danger"></div>
                                <div id="estimated-price" class="text-primary"></div>
                                <div class="max-column text-success"></div>
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary" disabled>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var estimatedPrice
        $(window).on('pageshow', function () {
            manipulateLimits()
        });

        $('#pay-currency').change(function () {
            manipulateLimits()
        });
        $('#amount').change(function () {
            manipulateLimits()
        });

        function manipulateLimits() {
            let amount = $('#amount').val()
            let currency = $('#pay-currency').find(":selected").val()
            minAmount = $('#pay-currency').find(":selected").attr('min_amount')
            maxAmount = $('#pay-currency').find(":selected").attr('max_amount')
            if (amount && amount !== "" && currency && currency !== "") {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "/api/v1/get-estimated-price",
                    type: "get",
                    dataType: "json",
                    data: {amount, currency},
                    success: function (response) {
                        $('.min-column').html(`Min: ` + minAmount)
                        $('.max-column').html(`Max: ` + maxAmount)
                        $('#estimated-price').html(`Est Price: ` + response.estimated_amount)
                        estimatedPrice = response.estimated_amount
                        $("#submit").removeAttr("disabled");
                    }
                });
            } else {
                $("#submit").attr("disabled", true);
            }
        }

        function validateForm() {
            minAmount = parseFloat($('#pay-currency').find(":selected").attr('min_amount'))
            maxAmount = parseFloat($('#pay-currency').find(":selected").attr('max_amount'))
            if (estimatedPrice < minAmount) {
                alert('The amount is less than the limit')
                return false
            } else if (estimatedPrice > maxAmount) {
                alert('The amount is more than the limit')
                return false
            } else return true
        }
    </script>
@endpush

