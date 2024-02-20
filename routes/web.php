<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

// Route::get('/sales', function () {
//     return view('sales.index');
// })->middleware(['auth'])->name('coffee.sales');

Route::middleware(['auth'])->group(function () {
    Route::get('/sales', [SaleController::class, 'index'])->name('coffee.sales');
    Route::post('/sales', [SaleController::class, 'store'])->name('coffee.sales.save');
});


Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

require __DIR__.'/auth.php';
