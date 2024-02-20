<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = config('constants.products');
        foreach($products as $row) {
            Product::create([
                'product_name' => $row['product_name'],
                'profit_margin_percent' => $row['profit_margin_percent'],
            ]);
        }
        $product = Product::find(1); // which is gold coffee
        if($product) {
            Order::whereNull('product_id')->update(['product_id'=>1]);
        }        
    }
}
