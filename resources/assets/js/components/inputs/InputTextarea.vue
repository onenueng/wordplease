<template>
    <div :class="componentGrid">
        <div class="form-group-sm">
            <label
                class="control-label topped"
                :for="field"
                v-if="label != null">
                <span v-html="label"></span>
                <a  data-toggle="tooltip"
                    role="button"
                    :title="labelAction.title"
                    v-if="labelAction !== {}"
                    @click="$emit(labelAction.event)"
                ><i :class="labelAction.icon"></i></a>
                <a  data-toggle="tooltip"
                    role="button"
                    :title="labelDescription"
                    v-if="labelDescription !== null"
                ><i class="fa fa-info-circle"></i></a>
                <span v-if="labelDescription !== null">:</span>
            </label>
            <textarea
                rows="1"
                :class="controlClass"
                :id="field"
                :maxlength="maxlength"
                :name="field"
                :placeholder="placeholder"
                :readonly="readonly"
                ref="textarea"
                @input="oninput"
                @keydown="onkeydown"
                @blur="showCharsRemaining = false"
            ></textarea>
            <transition name="slide-fade">
                <p :class="helperClass"
                   v-if="showCharsRemaining"
                ><strong>{{ charsRemaining }} chars remain.</strong></p>
            </transition>
        </div>
    </div>
</template>

<script>
import autosize from "autosize"
export default {
    props: {
        field: { default: Date.now() + '-' + Math.floor(Math.random()*1000) },
        grid: { default: null },
        label: { default: null },
        labelDescription: { default: null },
        labelAction: { default: () => { return {} } },
        maxlength: { default: 255 },
        placeholder: { default: null },
        readonly: { default: false },
        value: { required: true }
    },
    data () {
        return {
            controlClass: 'form-control',
            helperClass: 'text-muted',
            showCharsRemaining: false,
            charsRemaining: 0
        }
    },
    computed: {
        componentGrid() {
            let className
            if ( this.grid === null ) {
                className = 'col-xs-12'
            } else {
                let grid = this.grid.split('-')
                className = 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            }
            return (this.label === null) ? (className += ' fix-margin') : className
        }
    },
    created () {
        this.oninput = _.debounce(this.autosave, 5000)
    },
    mounted () {
        autosize(this.$refs.textarea)
        if (this.labelAction !== {}) { // init label action tooltip if available.
            $('a[title="' + this.labelAction.title + '"]').tooltip()
        }
        if (this.labelDescription !== null) { // init label tooltip if available.
            $('a[title="' + this.labelDescription + '"]').tooltip()
        }
    },
    methods: {
        onkeydown () {
            if (this.$refs.textarea.value.length > (.5*this.maxlength)) {
                this.charsRemaining = this.maxlength - this.$refs.textarea.value.length
                this.showCharsRemaining = true
                if (this.$refs.textarea.value.length > (.75*this.maxlength)) {
                    this.setTheme('danger')
                } else {
                    this.setTheme('warning')
                }
            } else {
                this.setTheme('')
            }
        },
        autosave() {
            if ( (this.value !== undefined) && !this.readonly && (this.value != this.lastSave) ) {
                this.$emit('input', this.$refs.textarea.value)
                this.$emit('autosave', this.field)
                this.lastSave = this.value
            }
        },
        setTheme(status) {
            let baseClass = ''
            let subClass = ''
            let show = false
            switch (status) {
                case 'warning':
                    baseClass = 'form-control textarea-warning'
                    subClass = 'text-warning'
                    show = true
                    break
                case 'danger':
                    baseClass = 'form-control textarea-danger'
                    subClass = 'text-danger'
                    show = true
                    break
                default :
                    baseClass = 'form-control'
                    subClass = 'text-muted'
            }
            if ( this.controlClass != baseClass ) {
                this.controlClass = baseClass
                this.helperClass = subClass
                this.showCharsRemaining = show
            }
        }
    }
}
</script>

<style>
.fix-margin { margin-top: .3em; }
.textarea-warning {
    /*Important stuff here*/
    -webkit-transition: flash-warning 3s ease-out;
    -moz-transition: flash-warning 3s ease-out;
    -o-transition: flash-warning 3s ease-out;
    transition: flash-warning 3s ease-out;
    animation: flash-warning 3s forwards linear normal;
}
@keyframes flash-warning {
    0% {
        background:#fff;
    }
    50% {
        background:#f0ad4e;
    }
    100% {
        background:#fff;
    }
}
.textarea-danger {
    /*Important stuff here*/
    -webkit-transition: flash-danger 3s ease-out;
    -moz-transition: flash-danger 3s ease-out;
    -o-transition: flash-danger 3s ease-out;
    transition: flash-danger 3s ease-out;
    animation: flash-danger 3s forwards linear normal;
}
@keyframes flash-danger {
    0% {
        background:#fff;
    }
    50% {
        background:#d9534f;
    }
    100% {
        background:#fff;
    }
}
</style>
