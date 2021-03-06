<?php

namespace App\Http\Controllers;

use App\Services\NoteManager;
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
            // prepare user store data
            $data['name'] = auth()->user()->name;
            $data['division'] = auth()->user()->division->name_eng_short;

            return view('vue-app')->with([
                'title'  => $data['name'],
                'jsFile' => 'note-index.js',
                'data'   => [
                    'user'      => $data,
                    'anPattern' => config('constant.AN_PATTERN'),
                    'admission' => "{}"
                ]
            ]);
        }
        return redirect('not-allowed');
    }

    public function audit()
    {
        return 'audit';
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $note = NoteManager::tryCreate(
                                $request->an,
                                $request->noteTypeId,
                                $request->class,
                                $request->retitle,
                                auth()->user()->id);

        if ( gettype($note) === 'string' ) {
            return ['reply_code' => 1, 'reply_text' => $note];
        }

        return ['reply_code' => 0, 'reply_text' => $note->editUrl()];
    }

    public function edit($id, Gate $gate)
    {
        $note = \App\Models\Notes\Note::find($id);

        if ( !($note && $gate->allows('edit-note', $note)) ) {
            return redirect('not-allowed');
        }

        $note->load(['ward', 'attending', 'noteType', 'division','admission.patient', 'detail']);
        $note->genExtraFields(); // got ward_name, attending_name, division_name
        $note->admission->genExtraFields(); // got formated datetime and LOS
        $note->detail->genExtraFields(); // got text of coded fields
        return view('notes.form', ['note' => $note]);

    }

    public function autosave($id, \Illuminate\Http\Request $request, Gate $gate)
    {
        $note = \App\Models\Notes\Note::find($id);

        if ( $note && $gate->allows('edit-note', $note) ) {
            return NoteManager::autosave($note, $request->field, $request->value);
        }

        return ['saved' => false];
    }
}
