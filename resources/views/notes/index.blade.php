@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<page-navbar
    link="/"
    brand="IPD Note"
    title="{{ auth()->user()->division->name_eng_short }}"
    an-pattern="^[0-9]{8}$"
    username="{{ auth()->user()->name }}">
</page-navbar>

<data-sheet
    pages-count={{ \App\Models\Lists\Division::count() / 5 + 1 }}>
</data-sheet>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
