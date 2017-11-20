<template>
    <label class="checkbox-inline">
        <input  type="checkbox"
                :name="field"
                :checked="thisChecked"
                @click="check()"/>
        {{ label }}
        <a  v-if="labelDescription !== undefined"
            role="button"
            data-toggle="tooltip"
            :title="labelDescription">
            <i class="fa fa-info-circle"></i>
        </a>
    </label>
</template>

<script>
    export default {
        props: {
            // field name on database.
            field: {
                type: String,
                required: false
            },
            label: {
                type: String,
                required: true  
            },
            // tooltip for label.
            labelDescription: {
                type: String,
                required: false
            },
            // checked state ['checked' or undefined].
            checked: {
                type: String,
                required: false
            },
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
                type: String,
                required: false
            },
            // event emit when checked/unchecked.
            emitOnCheck: {
                type: Array,
                required: false
            },
            // event emit when checked/unchecked.
            setterEvent: {
                type: String,
                required: false
            }
        },
        data () {
            return {
                // this element checked state ['checked' or ''].
                thisChecked: ''
            }
        },
        mounted() {
            // render checked state or not.
            this.thisChecked = (this.checked === undefined) ? '' : this.checked

            // init BT tooltip if labelDescription available.
            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip()
            }

            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value) => {
                    this.thisChecked = value
                })
            }            

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }

        },
        methods: {
            // handle check event.
            check() {
                this.thisChecked = (this.thisChecked == '') ? 'checked' : ''
                
                if (this.field !== undefined)
                    EventBus.$emit('autosave', this.field, (this.thisChecked.length > 0))
                
                if (this.emitOnCheck !== undefined) {
                    this.emitOnCheck.forEach((event) => {
                        // [name][mode 1:checked 2:unchecked][value]
                        // let emitParams = event.split('|')
                        if ((event[1] && (this.thisChecked == 'checked')) || 
                            (event[2] && (this.thisChecked == '')) ) {
                            EventBus.$emit(event[0], event[2])
                        }    
                    })
                    
                }
            }
        }
    }
</script>
