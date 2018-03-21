<?php

namespace App\Http\Controllers;

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

    public function store(\Illuminate\Http\Request $request)
    {
        $note = \App\Services\NoteCreator::tryCreate(
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

    public function edit($id)
    {
        $note = \App\Models\Notes\Note::with(['noteType', 'admission.patient'])->find($id);
        return view('notes.form', ['note' => $note]);
    }
}
