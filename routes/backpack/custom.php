<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('blog-category', 'BlogCategoryCrudController');
    Route::crud('blog-tag', 'BlogTagCrudController');
    Route::crud('blog', 'BlogCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('article', 'ArticleCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('menu-item', 'MenuItemCrudController');
    Route::crud('quater-year', 'QuaterYearCrudController');
}); // this should be the absolute last line of this file