<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\VueController;
Route::prefix('vue')
->name('vue.')
->controller(VueController::class)
->group(function() {
  Route::get('/','index')->name('vue');
  Route::get('/item/{id}','item')->name('item');
  Route::get('/cart','cart')->name('cart');
  Route::post('/cart/add','add')->name('cart.add');
  Route::post('/cart/remove','remove')->name('cart.remove');
  Route::post('/cart/clear','clear')->name('cart.clear');
  Route::get('/checkout','checkout')->name('checkout');
  Route::post('/checkout/submit','submit')->name('checkout.submit');
  Route::get('/checkout/complete','complete')->name('checkout.complete');
});

use App\Http\Controllers\AdminController;
Route::prefix('admin')
->middleware('auth')
->name('admin.')
->controller(AdminController::class)
->group(function() {
  Route::get('/','admin')->name('admin');
  Route::prefix('item')
  ->name('item.')
  ->group(function() {
    Route::get('/register','item_register')->name('register');
    Route::get('/list','item_list')->name('list');
    Route::get('/search','item_search')->name('search');
    Route::get('/detail/{id}','item_detail')->name('detail');
    Route::get('/edit/{id}','item_edit')->name('edit');
    Route::post('/store','item_store')->name('store');
    Route::post('/update/{id}','item_update')->name('update');
    Route::get('/delete/{id}','item_delete')->name('delete');
    Route::post('/comment/{id}','item_comment')->name('comment.store');
  });
  Route::prefix('order')
  ->name('order.')
  ->group(function() {
    Route::get('/list','order_list')->name('list');
    Route::get('/sending','order_sending')->name('sending');
    Route::get('/canceled','order_canceled')->name('canceled');
    Route::get('/search','client_search')->name('search');
    Route::get('/detail/{id}','order_detail')->name('detail');
    Route::get('/edit/{id}','order_edit')->name('edit');
    Route::post('/update/{id}','order_update')->name('update');
    Route::post('/delivery/{id}','order_delivery')->name('delivery');
    Route::get('/cancel/{id}','order_cancel')->name('cancel');
    Route::post('/comment/{id}','order_comment')->name('comment.store');
  });
  Route::prefix('user')
  ->name('user.')
  ->group(function() {
    Route::get('/register','user_register')->name('register');
    Route::post('/store','user_store')->name('store');
    Route::get('/list','user_list')->name('list');
    Route::get('/search','user_search')->name('search');
    Route::get('/detail/{id}','user_detail')->name('detail');
    Route::get('/edit/{id}','user_edit')->name('edit');
    Route::post('/update/{id}','user_update')->name('update');
    //Route::get('/delete/{id}','user_delete')->name('delete');
  });
});


require __DIR__.'/auth.php';
