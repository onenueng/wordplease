<template>
    <modal-document
        heading=""
        :setter-event="setterEvent">
        <div class="material-box clearfix" slot="body">
            <helper topic="" :groups=""></helper>
            <helper-tree topic="" :tree=""></helper-tree>
        </div>
        <div slot="footer">
            <button-app
                :action="putEvent"
                status="info"
                label="Put"
                size="lg">
            </button-app>
            <button-app
                action="toggle-event-name"
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
            }
        },
        data () {
            return {
                helper: {}
            }
        },
        computed : {
            helperText () {
                let text = ''
                for ( var key in this.helper) {
                    text += this.helper[key]
                    text = text.split(/(?:\r\n|\r|\n)/)[0] + ', '
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
            })
        }
    }
</script>
