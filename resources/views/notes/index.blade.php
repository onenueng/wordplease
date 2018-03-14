@extends('layout.app')

@section('title', auth()->user()->name)

@section('content')
<div class="modal fade" tabindex="-1" role="dialog" id="mymodal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<page-navbar
    link="/"
    brand="IPD Note"
    title="{{ auth()->user()->division->name_eng_short }}"
    an-pattern="^[0-9]{8}$"
    username="{{ auth()->user()->name }}">
</page-navbar>

<data-sheet
    pages-count={{ \App\Models\Lists\Division::count() / 5 + 1 }}>
</data-sheet>
@endsection

@section('app-js')
<script src="{{ mix('/js/create-note.js') }}"></script>
@endsection
