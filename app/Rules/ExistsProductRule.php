<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Product;

class ExistsProductRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the product with the given ID exists in the products table
        return Product::where('id', $value)->exists();
    }

    public function message()
    {
        return 'The selected product does not exist.';
    }
}
