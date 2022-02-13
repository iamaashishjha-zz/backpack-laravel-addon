<?php

use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

// Route::get('/', function () {
//     $today = \Carbon\Carbon::now();
//     // ->settings(
//     //     [
//     //         'locale' => app()->getLocale(),
//     //     ]
//     // );
//     // LL is macro placeholder for MMMM D, YYYY (you could write same as dddd, MMMM D, YYYY)
//     $dateMessage = $today->isoFormat('dddd, LL');
//     return view('welcome', [
//         'date_message' => $dateMessage
//     ]);
// });

Route::get('/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array(
        $locale,
        config('app.available_locales')
    )) {
        app()->setLocale($locale);
    }

    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::put('/', [App\Http\Controllers\HomeController::class, 'postChangeLanguage'])
//     ->name('language');

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);

// Route::get('language/{locale}', function ($locale) {
//     app()->setLocale($locale);
//     session()->put('locale', $locale);
//     return redirect()->back();
// })->name('language.switch');

// Route::post('/home', [App\Http\Controllers\HomeController::class, 'langChange'])->name('language.switch');
