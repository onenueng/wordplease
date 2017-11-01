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

// production route start here
Route::get('/get-select-choices/{fieldName}', 'ListController@getSelectChoices');

// dev route start here

Route::get('/', function () {
    return view('webpack');
});

Route::get('vue', function () {
    return view('vue');
});

Route::get('material', function () {
    return view('material');
});

Route::get('sidebar', function () {
    return view('bt-navbar-sidenav');
});

Route::get('index', function () {
    return view('index');
});

Route::get('edit', function () {
    return view('edit');
});

Route::post('test-post', function (Illuminate\Http\Request $request) {
    return $request->all();
});

Route::post('autosave', function (Illuminate\Http\Request $request) {
    // sleep(1);
    return $request->all();
});

Route::get('/get-actions', function () {
    return [
        [ 'label' => 'apple', 'link' => '/apple' ],
        [ 'label' => 'samsung', 'link' => '/samsung' ],
        [ 'label' => 'oppo', 'link' => '/oppo'],
    ];
});

Route::get('/get-ajax', function () {
    $items['suggestions'] = [
        [ 'value' => 'apple', 'data' => '1' ],
        [ 'value' => 'samsung', 'data' => '2' ],
        [ 'value' => 'oppo', 'data' => '3'],
    ];

    return response()->json($items);
});

Route::get('/get-creatable-notes/{an}', function ($an) {
    return [
        [ 
            'style' => 'cursor: pointer',
            'base' => 1,
            'as' => 1,
            'label' => 'Admission note' ,
            'title' => ''
        ],
        [ 
            'style' => 'cursor: pointer',
            'base' => 1,
            'as' => 4,
            'label' => 'Admission note as On service note',
            'title' => ''
        ],
        [ 
            'style' => 'cursor: not-allowed',
            'base' => 0,
            'as' => 0,
            'label' => '<s>Admission note as Off service note</s>',
            'title' => 'not allowed'
        ],
        [ 
            'style' => 'cursor: pointer',
            'base' => 2,
            'as' => 2,
            'label' => 'Discharge summary' ,
            'title' => ''
        ],
    ];
});
