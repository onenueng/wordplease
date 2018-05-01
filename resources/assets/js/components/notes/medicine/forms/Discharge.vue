<template>
    <div class="container-fluid">
        <condition-upon-discharge-helper
            v-if="showConditionUponDischargeHelper"
            setter-event="set-condition_upon_discharge">
        </condition-upon-discharge-helper>
        <panel heading='Admission data'>
            <div class="row">
                <input-text
                    label="Admit :"
                    field='datetime_admit'
                    grid="12-6-3"
                    :value="note.admission.datetime_admit_formated"
                    readonly>
                </input-text><!-- datetime_admit -->
                <input-text
                    label="Discharge :"
                    field='datetime_discharge'
                    grid="12-6-3"
                    :value="note.admission.datetime_discharge_formated"
                    readonly>
                </input-text><!-- datetime_discharge -->
                <input-text
                    label="Length of stay :"
                    field='lenght_of_stay'
                    grid="12-6-3"
                    :value="note.admission.lenght_of_stay"
                    readonly>
                </input-text><!-- datetime_discharge -->
                <input-suggestion
                    field="ward"
                    label="Ward :"
                    grid="12-6-3"
                    min-chars="2"
                    :value="note.ward_name">
                </input-suggestion><!-- ward -->
                <input-suggestion
                    field="attending"
                    label="Attending :"
                    grid="12-6-3"
                    min-chars="3"
                    :value="note.attending_name">
                </input-suggestion><!-- attending -->
                <input-suggestion
                    field="division"
                    label="Specialty :"
                    grid="12-6-3"
                    min-chars="3"
                    :value="note.division_name">
                </input-suggestion><!-- division -->
                <input-select
                    field="admit_reason"
                    label="Reason to admit :"
                    placeholder="if other choice, type here"
                    grid="12-6-3"
                    :value="note.detail.admit_reason_text">
                </input-select><!-- admit_reason -->
            </div><!-- wrap content with row class -->
        </panel><!-- Panel Admission Data -->
        <panel heading="Treatments Description">
            <div class="row">
                <input-rows v-for="tag in diagnosisTags" :key="tag.field"
                            :field="tag.field"
                            :label="tag.label"
                            :group-name='tag.groupName'
                            :items="tag.items"
                            :row-limit="tag.rowLimit">
                </input-rows>
                <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
                <input-rows v-for="tag in procedureTags" :key="tag.field"
                            :field="tag.field"
                            :label="tag.label"
                            :group-name='tag.groupName'
                            :items="tag.items"
                            :row-limit="tag.rowLimit">
                </input-rows>
                <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
                <div v-for="topic in topics" :key="topic.field">
                    <input-textarea
                        :field="topic.field"
                        :label="topic.label"
                        grid="12-12-12"
                        :value="topic.value"
                        :max-chars="topic.maxChars">
                    </input-textarea><!-- topic -->
                    <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
                </div><!-- topics -->
                <input-textarea
                    field="condition_upon_discharge"
                    label="Condition upon discharge :"
                    grid="12-12-12"
                    :value="note.detail.condition_upon_discharge"
                    label-action='{"emit": "toggle-condition-upon-discharge-helper", "icon": "h-square", "title": "Open helper" }'
                    max-chars="2000"
                    setter-event="set-condition_upon_discharge">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
                <input-select
                    field="discharge"
                    label="Discharge status :"
                    not-allow-other                    
                    grid="12-12-12"
                    :value="note.detail.discharge_text">
                </input-select><!-- discharge -->
                <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
            </div><!-- wrap content with row class -->
        </panel><!-- Treatments Description -->
        <panel heading="MD note">
            <div class="row">
                <input-textarea
                    field="MD_note"
                    :value="note.detail.MD_note"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea>
            </div><!-- wrap with row -->
        </panel><!-- MD Note -->
    </div><!-- note content -->
</template>

<script>
    import Panel from '../../../Panel.vue'
    import InputRows from '../../../inputs/InputRows.vue'
    import InputText from '../../../inputs/InputText.vue'
    import InputCheck from '../../../inputs/InputCheck.vue'
    import InputRadio from '../../../inputs/InputRadio.vue'
    import InputSelect from '../../../inputs/InputSelect.vue'
    import InputTextarea from '../../../inputs/InputTextarea.vue'
    import InputTextAddon from '../../../inputs/InputTextAddon.vue'
    import InputSuggestion from '../../../inputs/InputSuggestion.vue'
    import InputCheckGroup from '../../../inputs/InputCheckGroup.vue'
    import ConditionUponDischargeHelper from '../../../helpers/medicine/ConditionUponDischarge.vue'

    export default {
        components: {
            'panel' : Panel,
            'input-rows' : InputRows,
            'input-text' : InputText,
            'input-radio' : InputRadio,
            'input-check' : InputCheck,
            'input-select' : InputSelect,
            'input-textarea' : InputTextarea,
            'input-text-addon' : InputTextAddon,
            'input-suggestion' : InputSuggestion,
            'input-check-group' : InputCheckGroup,
            'condition-upon-discharge-helper': ConditionUponDischargeHelper
        },
        props: {
            serializedNote: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                note: {},
                store: {},
                getDataUrl: "/note-data/" + window.location.pathname.split("/")[2],
                showConditionUponDischargeHelper: false
            }
        },
        created () {
            this.note = JSON.parse(this.serializedNote)
            this.diagnosisTags = [
                {
                    field: 'principle_diagnosis',
                    label: 'Principle dagnosis :',
                    groupName: 'diagnosis',
                    items: this.note.admission.principle_diagnosis,
                    rowLimit: 1
                },
                {
                    field: 'comorbids',
                    label: 'Comorbids :',
                    groupName: 'diagnosis',
                    items: this.note.admission.comorbids,
                    rowLimit: 5
                },
                {
                    field: 'complications',
                    label: 'Complications :',
                    groupName: 'diagnosis',
                    items: this.note.admission.complications,
                    rowLimit: 5
                },
                {
                    field: 'external_causes',
                    label: 'External causes :',
                    groupName: 'diagnosis',
                    items: this.note.admission.external_causes,
                    rowLimit: 5
                },
                {
                    field: 'other_diagnosis',
                    label: 'Other diagnosis :',
                    groupName: 'diagnosis',
                    items: this.note.admission.other_diagnosis,
                    rowLimit: 5
                }
            ]
            this.procedureTags = [
                {
                    field: 'OR_procedures',
                    label: 'OR procedures :',
                    groupName: 'procedures',
                    items: this.note.admission.OR_procedures,
                    rowLimit: 5
                },
                {
                    field: 'non_OR_procedures',
                    label: 'Non OR procedure :',
                    groupName: 'procedures',
                    items: this.note.admission.non_OR_procedures,
                    rowLimit: 5
                }
            ]
            this.topics = [
                {
                    field: 'chief_complaint', value: this.note.detail.chief_complaint,
                    label: 'Chief complaint :', maxChars: 255
                },
                {
                    field: 'significant_findings', value: this.note.detail.significant_findings,
                    label: 'Significant findings :', maxChars: 2000
                },
                {
                    field: 'significant_procedured', value: this.note.detail.significant_procedured,
                    label: 'Significant procedured :', maxChars: 2000
                },
                {
                    field: 'hospital_course', value: this.note.detail.hospital_course,
                    label: 'Hospital course :', maxChars: 2000
                }
            ]
        },
        mounted () {
            EventBus.$on('toggle-condition-upon-discharge-helper', () => {
                if (this.showConditionUponDischargeHelper) {
                    $('#modal-condition-upon-discharge-helper').modal('hide')
                    setTimeout(() => { this.showConditionUponDischargeHelper = false }, 1000);
                } else {
                    this.showConditionUponDischargeHelper = true
                }
            })
        }
    }
</script>
