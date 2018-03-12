<?php
/*
|--------------------------------------------------------------------------
| production routes start here
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
    return view('welcome')->with('quote', App\Inspiration::inspireMe());
});

Route::get('/home', function() {
    return view('home');
});

Route::get('/not-allowed', function() {
    return view('not-allowed');
});

Route::get('/lists/{type}/{listName}', 'ListController@getList');

Route::get('/is-session-active', function() {
    return ['active' => ( app('request')->header('X-CSRF-TOKEN') == csrf_token() )];
});

// register
Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegisterForm']);
Route::post('/register/check-id', 'Auth\RegisterController@getUser');
Route::post('/register/is-data-available', 'Auth\RegisterController@isDataAvailable');
Route::post('/register', 'Auth\RegisterController@register');

// login
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login', 'Auth\LoginController@login');
Route::post('/front-end-login', 'Auth\LoginController@frontEndLogin');
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// user
Route::get('/profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
Route::get('/authenticated', ['as' => 'authenticated', 'uses' => 'UserController@authenticated']);

// dashboard
Route::get('/notes', ['as' => 'notes', 'uses' => 'NoteController@index']);
Route::get('/audit', ['as' => 'audit', 'uses' => 'NoteController@audit']); // TEMP USES

// *** NEED PROTECTION ***
Route::post('/admit/{an}', function (App\Contracts\PatientDataAPI $api, $an) {
    return $api->getAdmission($an);
});

//
// Route::get('/authenticated', 'UserController@authenticated');
// Route::get('/authenticated', ['as' => 'authenticated', 'uses' => 'UserController@authenticated']);


/*
|--------------------------------------------------------------------------
| development routes start here
|--------------------------------------------------------------------------
 */
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



Route::get('/test-pse', function (App\Contracts\UserAPI $api) {
    return $api->getUser(10022569);
});

Route::get('/test-waja', function () {
    $t = new Tests\TestWaja;
    return $t->checkRegistryData([]);
});
