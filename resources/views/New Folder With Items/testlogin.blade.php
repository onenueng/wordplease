@extends('form')

@section('content')
<h3><a href="/auth/logout">hello {{ $user->name }} {{ $user->role_name }} @ {{ $user->division_name }} click for logout.</a></h3>
<h4>{{ $user->sms }}</h4>

@endsection