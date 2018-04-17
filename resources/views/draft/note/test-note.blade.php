@extends('draft.layout.edit-master')

@section('content')
<panel heading="TEST">
    <non-operation-list></non-operation-list>
    <loggable
        field="principle_diagnosis"
        label="Principle Diagnosis :"
        value="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.">
    </loggable>
    <hr class="line" />
    <loggable
        field="comorbidity"
        label="Comorbidity :"
        value="Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur.">
    </loggable>
    <hr class="line" />
    <loggable
        field="complication"
        label="Complication :"
        value="Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.">
    </loggable>
    <hr class="line" />
    <loggable
        field="other_diagnosis"
        label="Other Diagnosis :"
        value="">
    </loggable>
    <hr class="line" />
    <loggable
        field="operation"
        label="Operation :"
        value="">
    </loggable>
    <hr class="line" />
    <loggable
        field="non_operation"
        label="Non-operation :"
        value="">
    </loggable>
    <hr class="line" />
</panel>
@endsection
