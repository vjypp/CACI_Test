<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Rules\ExistsProductRule;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SaleController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $constants['shipping_cost'] = config('constants.shipping_cost');
        $constants['profit_margin_percent'] = config('constants.profit_margin_percent');

        $products = Product::all();

        $orders = Order::with(['product'])->latest()->get();
        return view('sales.index', compact('orders', 'constants', 'products'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['required', 'numeric', 'min:0.01'],
            'product_id' => ['required', new ExistsProductRule],
        ]);

        $product = Product::find($request->product_id);

        $shipping_cost = config('constants.shipping_cost');
        if($product) {
            $profit_margin_percent = $product->profit_margin_percent;
        } else {
            $profit_margin_percent = config('constants.profit_margin_percent');
        }
        

        $quantity = $request->quantity;
        $product_id = $request->product_id;
        $unit_cost = $request->unit_cost;
        $cost = $quantity*$unit_cost;
        $profit_margin = $profit_margin_percent/100;

        $selling_price = ($cost/(1-$profit_margin)) + $shipping_cost;

        $order = Order::create([
            'quantity' => $request->quantity,
            'cost' => $request->unit_cost,
            'product_id' => $product_id,
            'selling_price' => $selling_price
        ]);

        return redirect()->back();;
    }
}
