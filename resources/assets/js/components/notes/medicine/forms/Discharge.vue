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
                <input-rows field="principle_diagnosis"
                            label="Principle diagnosis :"
                            group-name='dx'>
                </input-rows>
                <input-rows field="comorbids"
                            label="Comorbids :"
                            group-name='dx'
                            :items="note.admission.comorbids"
                            :row-limit="50">
                </input-rows>
                <input-rows field="complications"
                            label="Complications :"
                            group-name='dx'
                            :row-limit="50">
                </input-rows>
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
                    placeholder="if other choice, type here"
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

            this.topics = [
                {
                    field: 'principle_diagnosis', value: this.note.detail.principle_diagnosis,
                    label: 'Principle diagnosis :', maxChars: 255
                },
                {
                    field: 'comorbids', value: this.note.detail.comorbids,
                    label: 'Comorbids :', maxChars: 2000
                },
                {
                    field: 'complications', value: this.note.detail.complications,
                    label: 'Complications :', maxChars: 2000
                },
                {
                    field: 'external_causes', value: this.note.detail.external_causes,
                    label: 'External causes :', maxChars: 2000
                },
                {
                    field: 'other_diagnosis', value: this.note.detail.other_diagnosis,
                    label: 'Other diagnosis :', maxChars: 255
                },
                {
                    field: 'OR_procedures', value: this.note.detail.OR_procedures,
                    label: 'OR procedures :', maxChars: 2000
                },
                {
                    field: 'non_OR_procedures', value: this.note.detail.non_OR_procedures,
                    label: 'Non OR procedures :', maxChars: 2000
                },
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
