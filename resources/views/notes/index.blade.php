@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<modal-action></modal-action><!-- create note confirmation -->

<page-navbar
    link="/"
    brand="IPD Note"
    title="{{ auth()->user()->division->name_eng_short }}"
    username="{{ auth()->user()->name }}"
    an-pattern="^[0-9]{8}$">
</page-navbar>

<data-sheet
    pages-count={{ \App\Models\Lists\Division::count() / 5 + 1 }}>
</data-sheet>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
