<?php

use App\Http\Controllers\HomeController;
use GuzzleHttp\Psr7\Request;
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

Route::get('/', function () {
    return view('home.test');
});


Route::get('/payment', function () {
    return view('home.index');
});

Route::post('/locale', function () {
    session(['my_locale' => app('request')->input('locale')]);
    return redirect()->back();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);

Route::get('/checkout/payment/esewa', [
    'name' => 'eSewa Checkout Payment',
    'as' => 'checkout.payment.esewa',
    'uses' => 'EsewaController@checkout',
]);


// Route::get('/m', function () {
//     return view('home.test');
// });
// Route::get('/testModal', function () {
//     return view('home.test');
// });

Route::post('/checkout/payment/{order}/esewa/process', [
    'name' => 'eSewa Checkout Payment',
    'as' => 'checkout.payment.esewa.process',
    'uses' => 'EsewaController@payment',
]);

Route::get('/checkout/payment/{order}/esewa/completed', [
    'name' => 'eSewa Payment Completed',
    'as' => 'checkout.payment.esewa.completed',
    'uses' => 'EsewaController@completed',
]);

Route::get('/checkout/payment/{order}/failed', [
    'name' => 'eSewa Payment Failed',
    'as' => 'checkout.payment.esewa.failed',
    'uses' => 'EsewaController@failed',
]);
