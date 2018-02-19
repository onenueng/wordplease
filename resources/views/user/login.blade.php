@extends('layout.app')

@section('title', 'Login')

@section('content')
<login-page>
    
</login-page>

{{-- 
<h1>login page</h1>
<form action="/login" method="POST">
    {{ csrf_field() }}
    <label for="">id / email : </label><input type="text" name="org_id" required><br/>
    <label for="">password : </label><input type="password" name="password" required><br/>
    <input type="submit" value="login">
    @if ( session('error') )
        <b>{{ session('error') }}</b>
    @endif
</form>
 --}}
@endsection

@section('app-js')
<script src="{{ mix('/js/login.js') }}"></script>
@endsection
