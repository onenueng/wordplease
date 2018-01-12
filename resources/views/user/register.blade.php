@extends('layout.app')

@section('title', 'Register')

@section('content')

<register-page
    id-name="SAP ID"
    pattern="^\d{8}$">
</register-page>

@endsection

@section('app-js')
<script src="{{ mix('/js/register.js') }}"></script>
@endsection
