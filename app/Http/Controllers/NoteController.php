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
        return $this->getPatientData($an, 'an');
    }

    public function getPatient($hn)
    {
        return $this->getPatientData($hn, 'hn');
    }

    public function getPatientData($key, $mode)
    {
        $cacheLifeTime = 10; // minutes
        $prefix = $mode == 'an' ? 'an@' : 'hn@';

        if ( !Cache::has($prefix . $key) ) {
            if ( $mode == 'an' ) {
                $response = resolve('App\Contracts\PatientDataAPI')->getAdmission($key);
            } else {
                $response = resolve('App\Contracts\PatientDataAPI')->getPatient($key);
            }

            if ( $response['reply_code'] == 0 ) { // cache only 'an' with data available
                Cache::put($prefix . $key, $response, $cacheLifeTime);
            }

            return $response;
        }

        return Cache::get($prefix . $key);
    }

    public function getCreatableNotes($an)
    {
        $admission = $this->getAdmission($an);
        $creatableNotes = [];
        foreach ( auth()->user()->canCreateNotes as $note ) {
            $creatableNotes[] = $note->getCreateDescription($an, $admission['gender']);
            foreach ( $note->canRetitledTo() as $retitle ) {
                $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $retitle);
            }
        }
        return $creatableNotes;
    }

    public function tryCreateNote(\Illuminate\Http\Request $request)
    {
        // need $an, $noteTypeId, $retitle
        $patient = $this->getPatient($request->an);
        $admission = $this->getAdmission($request->an);

        // send $admission, $noteTypeId, $retitle, $retitleClass
        $note = NoteCreator::tryCreate($admission, $noteTypeId, $retitle, $retitleClass);

        return $request;
    }
}
