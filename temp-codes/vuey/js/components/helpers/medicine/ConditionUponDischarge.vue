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
                    { name: 'row_1', choices: [ 'รู้ตัวดี ถามตอบได้ปรกติ', 'ไม่รู้ตัว' ] },
                    { name: 'row_2', choices: [ 'ไม่มีไข้', 'ยังมีไข้' ] },
                    { name: 'row_3', choices: [ 'กินอาหารได้ตามปกติ', 'ยังกินได้น้อย' ] },
                    { name: 'row_4', choices: [ 'ไม่ท้องเสีย', 'ท้องเสียลดลง' ] },
                    { name: 'row_5', choices: [ 'ไม่อาเจียน', 'อาเจียนน้อยลง' ] },
                    { name: 'row_6', choices: [ 'ไม่ปวดท้อง', 'ปวดท้องลดลง' ] },
                    { name: 'row_7', choices: [ 'ไม่เหนื่อย', 'เหนื่อยลดลง', 'ยังเหนื่อยอยู่' ] },
                    { name: 'row_8', choices: [ 'ไม่บวม', 'บวมลดลง', 'ยังบวมอยู่' ] },
                    { name: 'row_9', choices: [ 'แขนขามีแรงดี', 'แขนขาขวาอ่อนแรง', 'แขนขาซ้ายอ่อนแรง', 'แขนขาทั้งสองข้างอ่อนแรง','ไม่มีแรง' ] }
                ],
                mobilityTree: {  // helper specific
                    name: 'row_10_0', choices: ['เดินได้', 'เดินได้เมื่อช่วยพยุง', 'นอนติดเตียง ลุกไม่ได้'],
                    children: [
                        { name: 'row_10_1', choices: ['ไม่มีแผลกดทับ', 'มีแผลกดทับที่ sacral grade ...'] },
                        { name: 'row_10_2', choices: ['รู้ตัวดี', 'ไม่รู้ตัว', 'ลืมตา ทำตามคำสั่ง', 'ลืมตา ไม่ทำตามคำสั่ง'] }
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
                if ( group == 'row_10_0' ) { // helper specific
                    if ( value == 'นอนติดเตียง ลุกไม่ได้' ) {
                        EventBus.$emit('row_10_0', true)
                    } else {
                        EventBus.$emit('row_10_0', false)
                        delete this.helper.row_10_1
                        delete this.helper.row_10_2
                    }
                }
            })
        }
    }
</script>
