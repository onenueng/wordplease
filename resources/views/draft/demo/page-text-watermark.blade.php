@extends('layout.vue-draft')

@section('content')
<!-- <input-rich-text></input-rich-text> -->
<toggle
    id='toggle-gender'
    v-model="gender"
    true-label='Male'
    new='Gender'
    false-label='Female'></toggle>
@endsection
