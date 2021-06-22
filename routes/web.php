<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;

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

Route::get('/', function () {
   $products = Product::all();
    return view('all-products',compact('products'));
});

Route::get('/create-product', function () {
    return view('create-product');
});

Route::post('/store-product', function (Request $request) {
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->save();
    return redirect('/all-products');
})->name('store-product');

Route::get('/all-products', function () {

	$products = Product::all();
    return view('all-products',compact('products'));
});

Route::get('/edit-product/{id}', function ($id) {
   
    $product =  Product::find($id);
    return view('edit-product',compact('product'));
});
Route::post('/update-product/{id}', function (Request $request,$id) {
    $product =  Product::find($id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->save();
    return redirect('/all-products');
})->name('update-product');

Route::delete('/delete-product/{id}', function ($id) {
   
    $product =  Product::find($id);
    $product->delete();

     return redirect('/all-products');
});




