@extends('draft.layout.edit-master')

@section('content')
    <panel heading="Diagnosis">
        <div class="row">
            <review-discharge
                field="hello"
                label="Principle"
                :items="[ { value: 'hello world what is your name my name is peter jackson', code: 'xyz' } ]"
                :row-limit="3">
            </review-discharge>
        </div>
    </panel>
@endsection