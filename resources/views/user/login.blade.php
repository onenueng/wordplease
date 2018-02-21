@extends('layout.app')

@section('title', 'Login')

@section('content')
<!-- app modal diaglog -->
<modal-dialog
    :heading="dialogHeading"
    :message="dialogMessage"
    :button-label="dialogButtonLabel">
</modal-dialog>

<login-page></login-page>
@endsection

@section('app-js')
<script src="{{ mix('/js/login.js') }}"></script>
@endsection
