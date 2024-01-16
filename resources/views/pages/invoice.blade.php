@extends('layouts.app', ['page' => __('Invoices'), 'pageSlug' => 'invoices'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Balance</div>
                    <div class="card-body">
                        <form method="post" action="{{route('make-invoice')}}">
                            @csrf
                            <div class="form-group">
                                <label for="Amount">USD Amount</label>
                                <input type="number" step="any" class="form-control" id="amount" name="price_amount" required min="50"
                                       placeholder="$100">
                            </div>
                            <div class="d-flex flex-column justify-content-around" style="padding:15px;padding-top:0px;">
                                <div class="min-column text-danger"></div>
                                <div id="estimated-price" class="text-primary"></div>
                                <div class="max-column text-success"></div>
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

