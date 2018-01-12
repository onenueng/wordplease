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
Route::get('/lists/{type}/{listName}', 'ListController@getList');
Route::get('/is-session-active', function(Illuminate\Http\Request $request) {
    return ['active' => ($request->header('X-CSRF-TOKEN') == csrf_token())];
});

Route::get('/register', 'Auth\RegisterController@showRegisterForm');
Route::post('/register/check-id', 'Auth\RegisterController@getUser');
Route::post('/register/is-data-available', 'Auth\RegisterController@isDataAvailable');

// dev route start here
Route::get('draft/{group}/{page}', function ($group, $page) {
    return view('draft.' . $group . '.' . $page);
});

Route::get('select-refresh', function () {
    App\Models\Lists\SelectItem::whereNotNull('field_name')->delete();
    App\Models\Lists\SelectItem::loadData('select_items');

    return "done";
});
Route::get('lists-refresh-all', function () {
    App\Models\Lists\Drug::whereNotNull('id')->delete();
    App\Models\Lists\Drug::loadData('drugs');

    App\Models\Lists\AttendingStaff::whereNotNull('id')->delete();
    App\Models\Lists\AttendingStaff::loadData('attending_staffs');

    App\Models\Lists\Ward::whereNotNull('id')->delete();
    App\Models\Lists\Ward::loadData('wards');

    App\Models\Lists\Division::whereNotNull('id')->delete();
    App\Models\Lists\Division::loadData('divisions');

    return "done";
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
    // sleep(2);
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

Route::get('/test-psp', function (App\Contracts\PatientDataAPI $api) {
    return $api->getPatient(53344980);
});


