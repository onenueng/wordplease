@extends('layout.app')

@section('title', 'Login')

@section('content')
<login-page></login-page>
@endsection

@section('app-js')
<script src="{{ mix('/js/login.js') }}"></script>
@endsection
