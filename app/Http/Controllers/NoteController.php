<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use \App\Contracts\PatientDataAPI;
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

    public function getAdmission($an, PatientDataAPI $api)
    {
        // implement cache
        return $api->getAdmission($an);
    }

    public function getCreatableNotes($an)
    {
        // get an from cache
        $creatableNotes = [];
        foreach (auth()->user()->canCreateNotes as $note) {
            // check gender then
            // check class unique
            $creatableNotes[] = [
                'style' => 'cursor: pointer',
                'base' => $note->id,
                'as' => 99,
                'label' => $note->name,
                'title' => 'Create ' . $note->name,
                'creatable' => true
            ];
            foreach ($note->canRetitledTo() as $title) {
                $creatableNotes[] = [
                    'style' => 'cursor: pointer',
                    'base' => $note->id,
                    'as' => 99,
                    'label' => $note->name . ' as ' . $title,
                    'title' => 'Create ' . $note->name . ' as ' . $title,
                    'creatable' => false
                ];
            }
        }

        return $creatableNotes;
    }
}
