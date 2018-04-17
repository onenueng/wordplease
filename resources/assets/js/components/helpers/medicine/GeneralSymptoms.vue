<template>
    <modal-document
        heading="General symptoms helper"
        :setter-event="setterEvent">
        <div class="clearfix" slot="body">
            <helper topic="general_symptoms" :groups="generalSymptoms"></helper>
        </div>
        <div slot="footer">
            <button-app
                :action="putEvent"
                status="info"
                label="Put"
                size="lg">
            </button-app>
            <button-app
                action="toggle-general-symptoms-helper"
                status="draft"
                label="Close"
                size="lg">
            </button-app>
        </div>
    </modal-document>
</template>

<script>
    import Helper from '../Helper.vue'
    import Document from '../../modals/Document.vue'

    export default {
        components: {
            'helper': Helper,
            'modal-document': Document
        },
        props: {
            setterEvent: {
                type: String,
                required: true
            },
            setLang: {
                type: String,
                required: false
            }
        },
        data () {
            return {
                helper: {},
                generalSymptoms: [
                    { name: 'a_fever', choices: [ 'ไม่มีไข้', 'มีไข้' ] },
                    { name: 'b_eating', choices: [ 'กินอาหารได้ตามปกติ', 'กินจุ', 'กินได้น้อย' ] },
                    { name: 'c_bore_eating', choices: [ 'ไม่เบื่ออาหาร ', 'เบื่ออาหาร ' ] },
                    { name: 'd_body_weight', choices: [ 'ไม่มีน้ำหนักลด', 'น้ำหนักลด', 'น้ำหนักเพิ่ม' ] },
                    { name: 'e_figure', choices: [ 'ปกติ', 'ผอมลง', 'อ้วนขึ้น' ] },
                    { name: 'f_sleeping', choices: [ 'นอนหลับดี', 'นอนไม่หลับ' ] }
                ]
            }
        },
        computed : {
            helperText () {
                let text = ''
                for ( var key in this.helper) {
                    text += this.helper[key]
                    text = text.split(/(?:\r\n|\r|\n)/)[0] + ( this.setLang === undefined ? ' ' : ', ')
                }
                return text
            }
        },
        created () {
            // Vue not actually destroyed component when v-if = false
            // So we need to use a unique event name for same
            // component that repeatly create/destroyed 
            this.putEvent = 'helper-put-' + Date.now()

            EventBus.$on(this.putEvent, () => {
                EventBus.$emit(this.setterEvent, this.helperText)
                EventBus.$emit('toggle-general-symptoms-helper') // helper specific
            })

            EventBus.$on('store-helper', (topic, group, value) => {
                this.helper[group] = value
            })
        }
    }
</script>
