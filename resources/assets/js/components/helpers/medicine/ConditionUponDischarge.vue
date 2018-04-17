<template>
    <modal-document
        heading="Condition upon discharge helper"
        :setter-event="setterEvent">
        <div class="clearfix" slot="body">
            <helper topic="condition_upon_discharge" :groups="conditionUponDischarge"></helper>
            <helper-tree topic="condition_upon_discharge" :tree="mobilityTree"></helper-tree>
        </div>
        <div slot="footer">
            <button-app
                :action="putEvent"
                status="info"
                label="Put"
                size="lg">
            </button-app>
            <button-app
                action="toggle-condition-upon-discharge-helper"
                status="draft"
                label="Close"
                size="lg">
            </button-app>
        </div>
    </modal-document>
</template>

<script>
    import Helper from '../Helper.vue'
    import HelperTree from '../Tree.vue'
    import Document from '../../modals/Document.vue'

    export default {
        components: {
            'helper': Helper,
            'modal-document': Document,
            'helper-tree': HelperTree
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
                putEvent: null,
                helper: {},
                conditionUponDischarge: [  // helper specific
                    { name: 'a_awareness', choices: [ 'รู้ตัวดี ถามตอบได้ปรกติ', 'ไม่รู้ตัว' ] },
                    { name: 'b_fever', choices: [ 'ไม่มีไข้', 'ยังมีไข้' ] },
                    { name: 'c_eating', choices: [ 'กินอาหารได้ตามปกติ', 'ยังกินได้น้อย' ] },
                    { name: 'd_diarrhea', choices: [ 'ไม่ท้องเสีย', 'ท้องเสียลดลง' ] },
                    { name: 'e_vomit', choices: [ 'ไม่อาเจียน', 'อาเจียนน้อยลง' ] },
                    { name: 'f_pain', choices: [ 'ไม่ปวดท้อง', 'ปวดท้องลดลง' ] },
                    { name: 'g_tired', choices: [ 'ไม่เหนื่อย', 'เหนื่อยลดลง', 'ยังเหนื่อยอยู่' ] },
                    { name: 'h_swelling', choices: [ 'ไม่บวม', 'บวมลดลง', 'ยังบวมอยู่' ] },
                    { name: 'i_weak', choices: [ 'แขนขามีแรงดี', 'แขนขาขวาอ่อนแรง', 'แขนขาซ้ายอ่อนแรง', 'แขนขาทั้งสองข้างอ่อนแรง','ไม่มีแรง' ] }
                ],
                mobilityTree: {  // helper specific
                    name: 'j_0_mobility',
                    choices: ['เดินได้', 'เดินได้เมื่อช่วยพยุง', 'นอนติดเตียง ลุกไม่ได้'],
                    children: [
                        { name: 'j_1_mobility', choices: ['ไม่มีแผลกดทับ', 'มีแผลกดทับที่ sacral grade ...'] },
                        { name: 'j_2_mobility', choices: ['รู้ตัวดี', 'ไม่รู้ตัว', 'ลืมตา ทำตามคำสั่ง', 'ลืมตา ไม่ทำตามคำสั่ง'] }
                    ]
                }
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
                EventBus.$emit('toggle-condition-upon-discharge-helper') // helper specific
            })

            EventBus.$on('store-helper', (topic, group, value) => {
                this.helper[group] = value
                if ( group == 'j_0_mobility' ) { // helper specific
                    if ( value == 'นอนติดเตียง ลุกไม่ได้' ) {
                        EventBus.$emit('j_0_mobility', true)
                    } else {
                        EventBus.$emit('j_0_mobility', false)
                        delete this.helper.j_1_mobility
                        delete this.helper.j_2_mobility
                    }
                }
            })
        }
    }
</script>
