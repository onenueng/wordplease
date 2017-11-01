@extends('index')

@section('background_image', "url('/assets/images/blu_stripes.png')")

@section('division_icon', 'fa-female')

@section('form_post_url', url('obgynnotes'))

@section('note_commands')
<li role="button"><a onclick="checkNote(2)"><span class="fa fa-pencil"></span> Create Labour and Delivery Summary</a></li>
<li role="button"><a onclick="checkNote(3)" title="กรณีคลอดทารกหลายคน ต้องสรุปรายงานทารกแรกเกิด 1 ฉบับ ต่อทารก 1 คน"><span class="fa fa-pencil"></span> Create Newborn Summary</a></li>
<li role="button"><a onclick="checkNote(4)"><span class="fa fa-pencil"></span> Create Undelivery Summary</a></li>
<li role="button"><a onclick="checkNote(5)"><span class="fa fa-pencil"></span> Create Pregnancy with abortive Outcome Summary</a></li>
<li role="button"><a onclick=""><span class="fa fa-folder-open"></span> View this AN IPD notes</a></li>
@endsection