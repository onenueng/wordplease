@extends('index')

@section('background_image', "url('/assets/images/footer_lodyas.png')")

@section('division_icon', 'fa-medkit')

@section('form_post_url', url('medicinenotes'))

@section('note_commands')
<li role="button"><a onclick="checkNote(7)"><span class="fa fa-pencil"></span> Create Admission Notes</a></li>
<li role="button"><a onclick="checkNote(8)"><span class="fa fa-pencil"></span> Create Discharge Summary</a></li>
<li role="button"><a onclick="checkNote(7)"><span class="fa fa-pencil"></span> Create Transfer Note</a></li>
<li role="button"><a onclick="checkNote(7)"><span class="fa fa-pencil"></span> Create On Service Notes</a></li>
<li role="button"><a onclick="checkNote(7)"><span class="fa fa-pencil"></span> Create Off Service Notes</a></li>
<li role="button"><a onclick=""><span class="fa fa-folder-open"></span> View this AN IPD notes</a></li>
@endsection