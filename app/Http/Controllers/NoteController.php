<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use \App\Contracts\PatientDataAPI;
use Illuminate\Support\Facades\Cache;
use \Illuminate\Contracts\Auth\Access\Gate;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return input select choices by field_name.
     *
     * @param  String  $fieldName
     * @return \Illuminate\Http\Response
     */
    public function index(Gate $gate)
    {
        if ( $gate->allows('create-note') ) {
            return view('notes.index');
        }
        return redirect('not-allowed');
    }

    public function audit()
    {
        return 'audit';
    }

    public function getAdmission($an)
    {
        $cacheLifeTime = 10; // minutes

        if ( !Cache::has('an@' . $an) ) {
            $admission = resolve('App\Contracts\PatientDataAPI')->getAdmission($an);

            if ( $admission['reply_code'] == 0 ) { // cache only 'an' with data available
                Cache::put('an@' . $an, $admission, $cacheLifeTime);
            }

            return $admission;
        }

        return Cache::get('an@' . $an);
    }

    public function getCreatableNotes($an)
    {
        $admission = $this->getAdmission($an);

        $creatableNotes = [];
        foreach (auth()->user()->canCreateNotes as $note) {
            $creatableNotes[] = $note->getCreateDescription($an, $admission['gender']);
            foreach ($note->canRetitledTo() as $title) {
                $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $title);
            }
        }

        return $creatableNotes;
    }
}
