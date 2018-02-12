@extends('layout.app')

@section('title', 'Login')

@section('content')

<h1>login page</h1>
<form action="/login" method="POST">
    {{ csrf_field() }}
    <label for="">id / email : </label><input type="text" name="ref_id" required><br/>
    <label for="">password : </label><input type="password" name="password" required><br/>
    <input type="submit" value="login">
</form>

@endsection

@section('app-js')
<script src="{{ mix('/js/register.js') }}"></script>
@endsection
