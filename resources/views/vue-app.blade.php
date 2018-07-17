@extends('layout.vue-app')

@section('title', $title)

@section('content')
<app ref="root"></app>
@endsection

@section('app-js')
<script src="{{ mix($jsFile) }}"></script>
@endsection
