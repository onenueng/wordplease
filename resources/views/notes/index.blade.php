@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<!-- Create note Navbar -->
<navbar
    home-link="/"
    department-name="Medicine"
    app-name="IPD Note"
    username="koramit"
    pattern="^[0-9]{8}$">
</navbar>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
