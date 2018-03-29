<?php
/*
|--------------------------------------------------------------------------
| production routes start here
|--------------------------------------------------------------------------
*/

// pages
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
    // return ['active' => false];
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

// APIs
Route::post('/get-admission/{an}', ['middleware' => 'auth', 'uses' => function ($an) {
    return \App\Services\NoteManager::getPatientData($an, 'an');
}]);
Route::post('/get-creatable-notes/{an}', ['middleware' => 'auth', 'uses' => function ($an) {
    return \App\Services\NoteManager::getCreatableNotes($an, auth()->user()->id);
}]);
Route::post('/try-create-note', 'NoteController@store');

// Edit note
Route::get('/note/{id}/edit', 'NoteController@edit');
Route::post('/note/{id}/autosave', 'NoteController@autosave');
// Route::get('/note-data/{id}/{fieldName}', 'NoteController@getData');
// Route::get('/get-note/{id}', 'NoteController@getNote');

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

    App\Models\Lists\Drug::whereNotNull('id')->delete();
    App\Models\Lists\Drug::loadData('drugs');
    return "done";
});

Route::get('init-data', function () {
    App\Models\Lists\Drug::whereNotNull('id')->delete();
    App\Models\Lists\Drug::loadData('drugs');

    App\Models\Lists\Ward::whereNotNull('id')->delete();
    App\Models\Lists\Ward::loadData('wards', 'create');

    App\Models\Lists\AttendingStaff::whereNotNull('id')->delete();
    App\Models\Lists\NoteType::whereNotNull('id')->delete();
    App\Models\Lists\Division::whereNotNull('id')->delete();

    App\Models\Lists\Division::loadData('divisions', 'create');
    App\Models\Lists\NoteType::loadData('note_types');
    App\Models\Lists\AttendingStaff::loadData('attending_staffs', 'create');

    App\Models\Lists\SelectItem::whereNotNull('field_name')->delete();
    App\Models\Lists\SelectItem::loadData('select_items');

    App\User::create([
                  'id' => 1,
                 'pln' => null,
                'name' => 'wordplease',
               'email' => 'wordplease',
              'org_id' => 'wordplease',
            'password' => str_random(12),
           'full_name' => 'เวิร์ดพลีส',
        'full_name_en' => 'wordplease',
    ]);

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

Route::get('/test-pse', function (App\Contracts\UserAPI $api) {
    return $api->getUser(10022569);
});

Route::get('/test-waja', function () {
    $t = new Tests\TestWaja;
    return $t->checkRegistryData([]);
});

Route::get('pagy', function () {
    // $pages = App\Models\Lists\Division::paginate(5,['*'],'page',3)->toArray()
    return App\Models\Lists\Division::paginate(5)->toArray()['data'];
});


Route::get('runtest/{an}', function ($an) {
    return \App\Services\NoteCreator::getCreatableNotes($an, 2);
    return \App\RunTest::createNote($an);
    return App\Models\Lists\NoteType::with(['users' => function ($query) {
        return $query->select('id')->where('id', 2);
    }])->where('users.id', 2)->get();
});

Route::get('/setupnote', function () { return view('notes.medicine.forms.admission'); });

Route::get('/ward-list', function () {
    for ( $i = 57300000; $i <= 57301234; $i++) {
        $admission = \App\Services\NoteManager::getPatientData($i, 'an');
        $wardId = !($admission['ward_name'])
                    ? 0
                    : \App\Models\Lists\Ward::foundOrNew(
                        [
                            'name' => $admission['ward_name'],
                            'name_short' => $admission['ward_name_short']
                        ],
                        'name'
                      );
        sleep(1);
    }

    return 'done';
});
