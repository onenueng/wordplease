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
        $minutes = 10;

        if ( !Cache::has('an@' . $an) ) {
            $admission = resolve('App\Contracts\PatientDataAPI')->getAdmission($an);

            if ( $admission['reply_code'] == 0 ) { // cache only 'an' with data available
                Cache::put('an@' . $an, $admission, $minutes);
            }

            return $admission;
        }

        return Cache::get('an@' . $an);
    }

    public function getCreatableNotes($an)
    {
        $admission = $this->getAdmission($an); //produce error
        // if ( !Cache::has('an@' . $an) ) {
        //     return [];
        // }
        // $admission = Cache::get('an@' . $an);
        $creatableNotes = [];
        foreach (auth()->user()->canCreateNotes as $note) {
            // check gender then
            // check class unique
            $noteParams = [
                'note_type_id' => $note->id,
                'retitle' => '',
                'label' => $note->name,
                'title' => 'Create ' . $note->name,
                'creatable' => true
            ];
            $creatableNotes[] = $noteParams;
            foreach ($note->canRetitledTo() as $title) {
                $creatableNotes[] = [
                    'note_type_id' => $note->id,
                    'retitle' => 'rename',
                    'label' => $note->name . ' as ' . $title,
                    'title' => 'Create ' . $note->name . ' as ' . $title,
                    'creatable' => false
                ];
            }
        }

        return $creatableNotes;
    }
}
