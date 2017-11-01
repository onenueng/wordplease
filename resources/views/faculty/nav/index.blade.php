@extends('index')

@section('background_image', "url('/assets/images/gplaypattern.png')")

@section('division_icon', 'fa-institution')

@section('form_post_url', url('facultynotes'))

@section('note_commands')
<li role="button"><a onclick="checkNote(1)"><span class="fa fa-pencil"></span> Create Discharge summary</a></li>
<li role="button"><a onclick=""><span class="fa fa-folder-open"></span> View this AN IPD notes</a></li>
@endsection