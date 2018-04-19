@extends('draft.layout.edit-master')

@section('content')
<div></div>
<input-rows></input-rows>
</div>

<panel heading="TEST">
    <input-rows></input-rows>
</panel>
<panel heading="Principle diagnosis">
    <loggable
        field="principle_diagnosis"
        label="Principle Diagnosis :"
        value="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.">
    </loggable>
</panel>
<panel heading="Comorbidity">
    <loggable
        field="comorbidity"
        label="Comorbidity :"
        value="Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur.">
    </loggable>
</panel>
<panel heading="Complication">
    <loggable
        field="complication"
        label="Complication :"
        value="Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.">
    </loggable>
</panel>
<panel heading="Other diagnosis">
    <loggable
        field="other_diagnosis"
        label="Other diagnosis :"
        value="">
    </loggable>
</panel>
<panel heading="operation">
    <loggable
        field="operation"
        label="Operation :"
        value="">
    </loggable>
</panel>
<panel heading="Non-operation">
    <loggable
        field="non_operation"
        label="Non-operation :"
        value="">
    </loggable>
    <non-operation-list></non-operation-list>
</panel>
<panel heading="Investigation">
    <loggable
        field="investigation"
        label="Investigation :"
        value="">
    </loggable>
    <investigation-list></investigation-list>
</panel>

@endsection
