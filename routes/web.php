<?php

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
    return view('webpack');
});

Route::get('vue', function () {
    return view('vue');
});

Route::get('index', function () {
    return view('index');
});

Route::post('test-post', function (Illuminate\Http\Request $request) {
    return $request->all();
});

Route::get('/get-actions', function () {
    return [
        [ 'label' => 'apple', 'link' => '/apple' ],
        [ 'label' => 'samsung', 'link' => '/samsung' ],
        [ 'label' => 'oppo', 'link' => '/oppo'],
    ];
});

Route::get('/get-creatable-notes', function () {
    return [
        [ 'base' => 1, 'as' => 1, 'label' => 'Admission note' ],
        [ 'base' => 1, 'as' => 4, 'label' => 'Admission note as On service note' ],
        [ 'base' => 1, 'as' => 5, 'label' => 'Admission note as Off service note' ],
        [ 'base' => 2, 'as' => 2, 'label' => 'Discharge summary' ],
    ];
});
