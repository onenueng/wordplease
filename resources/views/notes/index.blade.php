@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<!-- Main Navbar -->
<navbar
    link="/"
    brand="Medicine"
    title="IPD Note">
    <!-- Navbar Left Actions -->
    {{-- <create-note-form pattern="^[0-9]{8}$"></create-note-form> --}}
    {{-- <ul class="nav navbar-nav" slot="navbar-left">
        <create-note-form pattern="^[0-9]{8}$"></create-note-form>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled><u>HN 12345678 John Doe</u> | Create <span class="fa fa-file-text"></span></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="">a</a>
                    <a href="">b</a>
                    <a href="">c</a>
                </li>
            </ul>
        </li>
    </ul> --}}
    {{-- <div slot="navbar-left">
    <ul class="nav navbar-nav">
        <create-note-form pattern="^[0-9]{8}$"></create-note-form>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled v-if="isShow"><u>HN 12345678 John Doe</u> | Create <span class="fa fa-file-text"></span></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="">a</a>
                    <a href="">b</a>
                    <a href="">c</a>
                </li>
            </ul>
        </li>
    </ul>
    </div> --}}
    <navbar-left
        slot="navbar-left">
    </navbar-left>
    <!-- Navbar Right Actions -->
    <navbar-right
        slot="navbar-right"
        username="{{ auth()->user()->name }}">
    </navbar-right>
</navbar>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
