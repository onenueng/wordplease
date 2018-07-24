<template>
    <div>
        <div class="form-group-sm">
            <label class="control-label">
                <span v-html="label"></span>
                <a  v-if="labelAction !== undefined"
                    role="button"
                    @click="emitLabelActionEvent()"
                    data-toggle="tooltip"
                    :title="labelActionTitle">
                    <i :class="labelActionIcon"></i>
                </a>
                <a  v-if="labelDescription !== undefined"
                    role="button"
                    data-toggle="tooltip"
                    :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
                <span v-if="labelDescription !== undefined">:</span>
            </label>
            <transition name="slide-fade">
                <a  @click="reset()"
                    role="button"
                    v-show="showReset">
                    <i class="fa fa-remove"></i>
                </a>
            </transition>
            <label class="radio-inline" v-for="option in optionsObjects" :key="option.label">
                <input  type="radio"
                        :name="field"
                        :value="option.value"
                        @click="check(option.value)"
                        :checked="option.value == currentValue" />
                        <span v-html="option.label"></span>
                <a  v-if="option.labelDescription !== undefined"
                    role="button"
                    data-toggle="tooltip"
                    :title="option.labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
            </label>
        </div>

        <transition name="slide-fade">
            <div v-if="showExtra" class="form-group-sm extra">
                <slot></slot>
            </div>
        </transition>
    </div>

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
            value: {
                type: [String, Number],
                required: false
            },
            // tooltip for label.
            labelDescription: {
                type: String,
                required: false
            },
            // string in form of json {"emit": "", "icon": "", "title": "" }.
            labelAction: {
                type: [String, Object],
                required: false
            },
            // string in form fo array of json [{"label": "","value": ""},{...}].
            options: {
                type: [String, Array],
                required: true
            },
            // value to trigger extra content.
            triggerValue: {
                type: [String, Number],
                required: false
            },
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
                type: String,
                required: false
            },
            // listen to this event name to set this component value.
            setterEvent: {
                type: String,
                required: false
            },
            storeData: {
                type: String,
                required: false
            },
            emitOnUpdate: {
                type: String,
                required: false
            }
        },
        data () {
            return {
                showReset: false,
                currentValue: null,
                showExtra: false
            }
        },
        methods: {

            autosave() {
                if (this.field !== undefined) {
                    EventBus.$emit('autosave', this.field, this.currentValue)
                    if ( this.storeData !== undefined ) {
                        EventBus.$emit(this.storeData, this.field, this.currentValue)
                    }
                }

                if ( this.emitOnUpdate !== undefined ) {
                    EventBus.$emit(this.emitOnUpdate, this.currentValue)
                }
            },

            check(value) {
                // check if has extra contents.
                if (this.hasDefaultSlot) {
                    if (this.isTriggerExtra(value)) {
                        if (!this.showExtra) {
                            this.showExtra = true
                        }
                    } else {
                        if (this.showExtra) {
                            this.showExtra = false
                        }
                    }
                }

                // show reset icon.
                if (!this.showReset) {
                    this.showReset = true
                }

                // check if value change.
                if (this.currentValue != value) {
                    this.currentValue = value
                    this.autosave()
                }

                // check if need to store
            },
            // reset to unchecked all options.
            reset() {
                this.showReset = false
                this.currentValue = null
                if (this.hasDefaultSlot) {
                    this.showExtra = false
                }
                this.autosave()
            },
            // return checked value is trigger value or not.
            isTriggerExtra(value) {
                if ((typeof this.triggerValues) == 'object') {
                    let show = false
                    this.triggerValues.forEach((eachValue) => {
                        if (eachValue == value) {
                            show = true
                        }
                    })
                    return show
                }
                return (value == this.triggerValues)
            },
            // emit event on label action.
            emitLabelActionEvent() {
                EventBus.$emit(this.labelActionEmitEventName)
            }
        },
        mounted () {
            // init label tooltip if available.
            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip()
            }

            // init label action icon tooltip if available.
            if (this.labelAction !== undefined) {
                $('a[title="' + this.labelActionTitle + '"]').tooltip()
            }

            // init each option label tooltip if available.
            this.optionsObjects.forEach((option) => {
                if (option.labelDescription !== undefined) {
                    $('a[title="' + option.labelDescription + '"]').tooltip()
                }
            })

            // listen to event to set option value.
            if (this.setterEvent !== undefined) {
                // let eventName = this.setterEvent != '' ? this.setterEvent : 'set-' + this.field
                
                EventBus.$on(this.setterEvent, (value) => {
                    this.check(value)
                })
            }

            if (this.value !== undefined && this.value !== null) {

                this.currentValue = this.value

                this.showReset = true

                if (this.hasDefaultSlot) {
                    this.showExtra = this.isTriggerExtra(this.value)
                } else {
                    this.showExtra = false
                }
            }

            if (this.needSync !== undefined) {
                let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
                    axios.get(url)
                         .then( (response) => {
                            check(response.data)
                         })
                         .catch( (error) => {
                            console.log(error)
                         })
            }
        },
        computed: {
            optionsObjects() {
                if ( typeof this.options == 'string' ) {
                    return JSON.parse(this.options)
                }
                return this.options
            },

            // check if has content in default slot.
            hasDefaultSlot() {
                // return !!this.$slots.default
                return this.$slots.default === undefined ? false : true
            },
            // extract label action emit event name.
            labelActionEmitEventName() {
                if (this.labelAction !== undefined) {
                    return typeof this.labelAction == 'string' 
                           ? JSON.parse(this.labelAction).emit
                           : this.labelAction.emit
                }
                return ''
            },
            // extract label action icon.
            labelActionIcon() {
                if (this.labelAction !== undefined) {
                    return 'fa fa-' + (typeof this.labelAction == 'string'
                                       ? JSON.parse(this.labelAction).icon
                                       : this.labelAction.icon)
                }
                return ''
            },
            // extract label action icon title.
            labelActionTitle() {
                if (this.labelAction !== undefined) {
                    return typeof this.labelAction == 'string'
                           ? JSON.parse(this.labelAction).title
                           : this.labelAction.title
                }
                return ''
            },
            triggerValues() {
                if (this.triggerValue !== undefined) {
                    return JSON.parse(this.triggerValue)
                }
                return null
            }
        }
    }
</script>

<style>
    div.extra {
        font-style: italic;
        color: #757575;
    }
</style>
