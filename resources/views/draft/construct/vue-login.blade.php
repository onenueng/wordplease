@extends('layout.vue-app')

@section('title', 'Login')

@section('content')
<login-page ref="root"></login-page>
@endsection

@section('app-js')
<script src="{{ mix('/js/vue-login.js') }}"></script>
@endsection
