@extends('layouts.app', ['page' => __('Deposit'), 'pageSlug' => 'Deposit'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Balance</div>
                    <div class="card-body">
                        <form method="post" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="Amount">Amount</label>
                                <input type="number" class="form-control" id="input1" name="input1" placeholder="Enter input">
                            </div>
                            <div class="form-group">
                                <label for="Currency">Currency</label>
                                <select class="form-control" id="currency" name="currency">
                                    <option value="USD" class="comboBox">USD</option>
                                    <option value="IRR" class="comboBox">IRR</option>
                                    <option value="TRL" class="comboBox">TRL</option>
                                    <option value="EUR" class="comboBox">EUR</option>
                                    <option value="AED" class="comboBox">AED</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
