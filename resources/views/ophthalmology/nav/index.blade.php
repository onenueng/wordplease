@extends('index')

@section('background_image', "url('/assets/images/subtle_white_mini_waves.png')")

@section('division_icon', 'fa-eye')

@section('form_post_url', url('ophthalmologynotes'))

@section('note_commands')
<li role="button"><a onclick="checkNote(6)"><span class="fa fa-pencil"></span> Create Discharge summary</a></li>
<li role="button"><a onclick=""><span class="fa fa-folder-open"></span> View this AN IPD notes</a></li>
@endsection