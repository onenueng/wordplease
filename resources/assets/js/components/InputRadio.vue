<template>
    <div>
        <div class="form-group-sm">
            <label class="control-label">{{ label }}
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
            <label class="radio-inline" v-for="option in JSON.parse(options)"> 
                <input  type="radio"
                        :name="field"
                        :value="option.value"
                        @click="check(option.value)"
                        :checked="option.value == currentValue" />
                        {{ option.label }}
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
                type: String,
                required: false  
            },
            // tooltip for label.
            labelDescription: {
                type: String,
                required: false
            },
            // string in form of json {"emit": "", "icon": "", "title": "" }.
            labelAction: {
                type: String,
                required: false
            },
            // string in form fo array of json [{"label": "","value": ""},{...}].
            options: {
                type: String,
                required: true  
            },
            // value to trigger extra content.
            triggerValue: {
                type: String,
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
                if (this.field !== undefined)
                    EventBus.$emit('autosave', this.field, this.currentValue)
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
                return (value == this.triggerValue)
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
            JSON.parse(this.options).forEach((option) => {
                if (option.labelDescription !== undefined) {
                    $('a[title="' + option.labelDescription + '"]').tooltip()
                }
            })

            // listen to event to set option value.
            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value) => {
                    this.check(value)
                    EventBus.$emit('show-alert', this.label.replace(' :', '') + ' also checked', 'success')
                });
            }

            if (this.value !== undefined) {
                
                this.currentValue = this.value
                
                this.showReset = true

                if (this.value == this.triggerValue) {
                    this.showExtra = true
                }

            }

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }
        },
        computed: {
            // check if has content in default slot.
            hasDefaultSlot() {
                return !!this.$slots.default;
            },
            // extract label action emit event name.
            labelActionEmitEventName() {
                if (this.labelAction !== undefined) {
                    return JSON.parse(this.labelAction).emit;
                }
                return '';
            },
            // extract label action icon.
            labelActionIcon() {
                if (this.labelAction !== undefined) {
                    return 'fa fa-' + JSON.parse(this.labelAction).icon;
                }
                return '';
            },
            // extract label action icon title.
            labelActionTitle() {
                if (this.labelAction !== undefined) {
                    return JSON.parse(this.labelAction).title;
                }
                return '';
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
