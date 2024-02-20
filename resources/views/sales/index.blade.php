
@extends('layouts.app')
 
@section('section')
<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form class="form-inline" method="post" action="{{ route('coffee.sales.save') }}">
                @csrf
                <div class="form-group">
                    <label class="" for="quantity">Quantity:</label>
                    <br>
                    <input type="number" class="form-control" onkeyup="calculateSellingPrice()" name="quantity" id="quantity" required min="1">
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="" for="unit_cost">Unit Cost:</label>
                    <br>
                    <input type="text" class="form-control" onkeyup="calculateSellingPrice()" name="unit_cost" id="unit_cost" required min="0.01">
                    @error('unit_cost')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="" for="unit_cost">Selling Price:</label>
                    <p id="selling_price">£00</p>
                </div>
                <div class="form-group">
                    <label class="" for="unit_cost"></label>
                    <br>
                    <input type="submit" class="btn btn-info" value="Record Sale">
                </div>
                </form>
                <h2>Previous Sales</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Selling Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $row)
                    <tr>
                        <td>{{$row->quantity}}</td>
                        <td>£{{$row->cost}}</td>
                        <td>£{{$row->selling_price}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function calculateSellingPrice() {
        // Get input values
        var quantity = parseFloat(document.getElementById('quantity').value);
        var unitCost = parseFloat(document.getElementById('unit_cost').value);
        var shippingCost = parseInt("{{$constants['shipping_cost']}}");
        var profitMarginPercent = parseInt("{{$constants['profit_margin_percent']}}");
        // Calculate cost
        var cost = quantity * unitCost;
        // Calculate profit margin
        var profitMargin = profitMarginPercent / 100;
        if(cost && profitMargin ){
             // Calculate selling price
            var sellingPrice = (cost / (1 - profitMargin)) + shippingCost;
            // Display selling price
            document.getElementById('selling_price').innerHTML = '£'+sellingPrice.toFixed(2);
        }
    }

</script>
@endpush