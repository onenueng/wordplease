@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<page-navbar
    link="/"
    brand="Note@AN"
    title="HN@Patient"
    username="{{ auth()->user()->name }}">
</page-navbar>

<note></note>

@endsection

@section('app-js')
<script src="{{ mix('/js/medicine-admission-note.js') }}"></script>
@endsection
