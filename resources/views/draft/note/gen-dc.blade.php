@extends('draft.layout.edit-master')

@section('content')

<panel heading="General - Discharge Summary">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <input-textarea
                field="diagnosis"
                label="Diagnosis :"
                max-chars="255"
                placeholder="Just one diagnosis">
            </input-textarea>

            <input-textarea
                field="complications"
                label="Complications :"
                placeholder="description"
                max-chars="1000">
            </input-textarea>
        </div>
        <div class="col-xs-12 col-md-6">
            <input-textarea
                field="operation"
                label="Operation (Operation/Date/Surgeon) :"
                placeholder="description"
                max-chars="1000">
            </input-textarea>

            <input-textarea
                field="result of Treatment"
                label="Result of Treatment :"
                placeholder="description"
                max-chars="1000">
            </input-textarea>
        </div>
        <div class="col-xs-12 col-md-6">
            <input-select
                field="discharge_status"
                label="Discharge Status :"
                not-allow-other>
            </input-select>
        </div>

        <div class="col-xs-12 col-md-6">
            <input-select
                field="discharge_type"
                label="Discharge Type :"
                not-allow-other>
            </input-select>
        </div>
    </div>
</panel>

<panel heading="History">
    <div class="row">
    <div class="col-xs-12">
            <input-textarea
                field="history"
                placeholder="history description"
                max-chars="1000">
            </input-textarea>
        </div>

        <div class="col-xs-12 col-md-6">
            <input-textarea
                field="history_examination"
                label="Examination :" 
                placeholder="description"
                max-chars="1000">
            </input-textarea>
        </div>

        <div class="col-xs-12 col-md-6">
            <input-textarea
                field="history_investigation"
                label="Investigation"
                placeholder="description"
                max-chars="1000">
            </input-textarea>
        </div>
    </div>
</panel>

<panel heading="Prognosis">
    <div class="row">
    <div class="col-xs-12">
        <input-textarea
            field="prognosis"
            placeholder="description"
            max-chars="1000">
        </input-textarea>
    </div>  
    </div>
</panel>

<panel heading="Appointment">
    <div class="row">
        <input-textarea
            field="appointment_note"
            placeholder="note"
            grid="12-12-12">
        </input-textarea>
    </div>
</panel>

<panel heading="Home medications">
    <div class="row">
        <input-textarea
            field="home_medication"
            grid="12-12-12">
        </input-textarea>
    </div>
</panel>
@endsection
