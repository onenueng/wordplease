@extends('layout.vue-draft')

@section('content')
<!-- <input-rich-text></input-rich-text> -->
<toggle
    id='toggle-gender'
    true-label='ชาย'
    false-label='หญิง'></toggle>
<toggle
    id='employee-type'
    true-label='เผลอ'
    false-label='ไม่เผลอ'></toggle>
@endsection
