@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<page-navbar
    link="/"
    brand="Medicine"
    title="IPD Note"
    an-pattern="^[0-9]{8}$"
    username="{{ auth()->user()->name }}">
</page-navbar>

<pagination
    pages-count="22">
</pagination>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
