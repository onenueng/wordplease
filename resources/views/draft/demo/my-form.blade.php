@extends('layout.vue-draft')

@section('title', 'My Form')

@section('body')
{{-- page navbar --}}
<page-navbar
    :brand="{ link: '/', title: 'IPD Note', subTitle: 'My Form' }" >
    <navbar-left slot="navbar-left">
        <li><a href="">HN: xxxxxxxx Patient Name</a></li>
    </navbar-left>
    <navbar-right slot="navbar-right">
        <li class="active"><a href="">username</a></li>
        <li><a href=""><i class="fa fa-sign-out"></i></a></li>
    </navbar-right>
</page-navbar>

{{-- form content --}}
<panel
    heading="SECTION A">
    <div class="row">
        <input-text
            label="Chief complaint"
            v-model="inputText"
            label-description="ไม่เกิน 1000 ตัวอักษร"
            grid="12-6-3"
            placeholder="please input this field"
            pattern="^[0-9]*$"
            invalid-response-text="hello world"
        ></input-text>
        <input-text
            label="Chief complaint"
            grid="12-6-3"
            :readonly="true"
        ></input-text>
        <input-suggestion
            field="ward"
            label="Ward :"
            grid="12-6-3"
            min-chars="2"
        ></input-suggestion>
        <input-suggestion
            field="division"
            label="Division :"
            grid="12-6-3"
            min-chars="2"
        ></input-suggestion>
        <input-select
            field="admit_reason"
            label="List :"
            grid="12-6-3"
        ></input-select>
        <input-textarea
            label="Textarea"
            maxlength="50"
        ></input-textarea>
        <div class="col-xs-12 form-inline">
            <button-app
                size="lg"
                status="success"
            ></button-app>
            <button-app
                status="default"
            ></button-app>
            <button-app
                size="sm"
                status="secondary"
                no-tab-stop
            ></button-app>
            <button-app
                size="xs"
                status="info"
            ></button-app>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <input-radio
                v-model="inputRadio"
                label="Options"
                :options="[{label: 'One', value: 1}, {label: 'Two', value: 2}]"
                :trigger-values="[1]"
            ><h1>Hello radio</h1></input-radio>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <input-check
                label="HBC"
                v-model="inputCheck"
            ></input-check>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <input-check
                label="HIV"
                status="danger"
            ></input-check>
        </div>
        <div class="col-xs-12">
            <input-check-group
                label="Check group : "
                :checks="checks"
                :models="checkModels"
            ></input-check-group>
        </div>
    </div>
</panel>

@endsection
