<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Pages route...
Route::get('/', function () {return view('welcome');});
Route::get('/home', function () {return view('welcome');});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// User route...
Route::get('dashboard', 'UsersController@dashboard');

// Notes
Route::get('notes', 'IPDNote\NotesController@index');
// Faculty Notes Controller.
Route::resource('facultynotes','IPDNote\Faculty\FacultyNotesController');
// Route::post('facultynotes', 'IPDNote\Faculty\FacultyNotesController@store');
// Route::get('facultynotes', 'IPDNote\Faculty\FacultyNotesController@test');
// Medicine Notes Controller.
Route::resource('medicinenotes','IPDNote\Medicine\MedicineNotesController');
// Ophthalmology Notes Controller.
Route::resource('ophthalmologynotes','IPDNote\Ophthalmology\OphthalmologyNotesController');
Route::get('/drawing/ophthalmology/{noteID}/{view}','IPDNote\Ophthalmology\OphthalmologyNotesController@createDrawing');
// Obgyn Notes Controller.
Route::resource('obgynnotes','IPDNote\Obgyn\ObgynNotesController');


// Itemize.
Route::get('itemize/attending/{term}','ItemizesController@getAttendingList');
Route::get('itemize/ward/{term}','ItemizesController@getWardList');
Route::get('itemize/division/{term}','ItemizesController@getDivisionList');
Route::get('itemize/drug/{term}','ItemizesController@getDrugList');

// Route::post('/', function () { //for testing
//     $input = Request::all();
//     // echo 'x' . serialize($input['x']) . '<br>' ;
//     // echo 'y' . serialize($input['y']) . '<br>' ;
//     // echo 'd' . serialize($input['d']) . '<br>' ;
//     // echo 'c' . serialize($input['c']) . '<br>' ;
//     // echo 's' . serialize($input['s']) . '<br>' ;
//     return $input;
    
// });




// test template generator.
// Route::get('/gag', function () {
//     return view('medicine.admission.gag');
// });

// test canvas original code.
// Route::get('/canvas', function () {
//     return view('canvas');
// });

// Route::get('/test', function () {
//     return view('test');
// });

// Route::get('/imajs', function () {
//     return view('canvas');
// });

// admission route
// Route::get('medicine/note/admission', function () {
//     return view('medicine.note.admission.form');
// });

// Route::get('medicine/admit/note/{an}', function () {
//     return view('medicine.admission.note');
// });

////////////////////////////////

// test fabric.
Route::get('fabric', function() {
    // return view('drawings.ophthalmology.operations');
    return view('fabtest');
    // return view('test_bs');
});

Route::get('dataurl', function() {
    return view('dataurl');
});

Route::get('/drawing/{div}/{view}', function($div, $view) {
    return "Hello $div - $view";
});

// test drawing.
// Route::get('drawing/{name}/edit', function($name) {
//     $anote = App\IPDNote\Medicine\MedicineAdmissionNote::where('note_id',2)->first();
//     $params = explode('-',$name);
//     if ($params[0] == 'med') {
//         session(['outline_img_src' => '/assets/images/drawings/medicine/' . $params[1] . '.png']);
//     } elseif ($params[0] == 'eye') {
//         session(['outline_img_src' => '/assets/images/drawings/ophthalmology/' . $params[1] . '.png']);
//     } else {
//         return redirect()->back();
//     }

//     // session(['outline_img_src' => '/assets/images/drawings/ophthalmology/' . $name . '.png']);
//     // return session('outline_img_src');
//     return view('drawing.general',compact('anote'));
// });
// test canvas touch.
Route::get('tcanvas',function () {
    return view('testing.testcanvas');
});

// test class methods.
Route::get('test/comorbid/{id}',function ($id) {
    $anote = App\IPDNote\Medicine\MedicineAdmissionNote::where('note_id',$id)->first();
    return nl2br($anote->comorbidToString());
});
Route::get('test/reason/{id}',function ($id) {
    $anote = App\IPDNote\Medicine\MedicineAdmissionNote::where('note_id',$id)->first();
    return nl2br($anote->reasonAdmitToString());
});
Route::get('test/significantFiding/{id}',function ($id) {
    $anote = App\IPDNote\Medicine\MedicineAdmissionNote::where('note_id',$id)->first();
    return nl2br($anote->getSignificantFinding());
});
Route::get('test/hospitalCourse/{id}',function ($id) {
    $anote = App\IPDNote\Medicine\MedicineAdmissionNote::where('note_id',$id)->first();
    return nl2br($anote->getHospitalCourse());
});

Route::get('user/profile', 'UsersController@showProfile')->name('profile');
Route::get('fa', function () {
    $notes = \App\IPDNote\Note::where('note_type_id', '22')->get();
    foreach ($notes as $note) {
    	// if ($note)
    		echo "noteID => " . $note->id;
    }
    // if (isset($note))
    // if ($note->AN == $AN) 
    // return ('2' == '1') ? 'a' : 'd'; // admit or discharge.
} );

// Route::get('drug', function () {
//     // return 'heelo';
//     // $drugs = \App\Itemizes\Drug::all();
//     //     foreach ($drugs as $drug) {
//     //         $drug->key = $drug->name . " | " . $drug->generic_name . " | " . $drug->trade_name . " | " . $drug->synonym;
//     //         $drug->save();
//     //     }
//     return \App\Itemizes\Drug::test();
// });