@extends('layout.app')

@section('title', 'Register')

@section('content')
<!-- app modal diaglog -->
<modal-dialog
    :heading="dialogHeading"
    :message="dialogMessage"
    :button-label="dialogButtonLabel">
</modal-dialog>

<register-page
    id-name="SAP ID"
    pattern="^100([0-9]{5})$">
</register-page>

@endsection

@section('app-js')
<script src="{{ mix('/js/register.js') }}"></script>
@endsection
