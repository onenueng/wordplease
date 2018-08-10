@extends('layout.app')

@section('custom-style')
<style>
body {
   padding-top: 0px!important;
}
</style>
@endsection

@section('body')
<div class="col-md-10 col-md-offset-1">
    <form action="/test-form-post" method="POST">
        <label for="patient_name" class="control-label">Patient name :</label>
        <input id="patient_name" name="patient_name"  type="text" class="form-control">
        <button class="btn btn-primary" type="submit">Create</button>
    </form>
</div>
@endsection