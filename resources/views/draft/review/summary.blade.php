@extends('draft.layout.edit-master')

@section('content')
    <panel heading="Diagnosis">
        <div class="row">
            <review-discharge
                field="hello"
                label="Principle"
                :items="[ { value: 'hello world whai is your name my name is peter jackson' } ]"
                :row-limit="3">
            </review-discharge>
        </div>
    </panel>
@endsection
