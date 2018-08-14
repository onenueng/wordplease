<template>
<label
    :class="'checkbox-inline underline-animate clear-padding ' + ( disabled ? '' : status)"
    @click="check">
    <div :class="'material-checkbox-group ' + (disabled ? '' : status)">
        <input
            class="material-checkbox"
            type="checkbox"
            :checked="checked !== undefined ? checked : isChecked"
            :disabled="disabled"
            :id="field !== undefined ? field:id"
            :name="field !== undefined ? field:id"
            ref="input" />
        <label
            :class="'material-checkbox-group-label ' + (disabled ? '' : status)"
            :for="field">{{ label }}
            <a  data-toggle="tooltip"
                role="button"
                :title="labelDescription"
                v-if="labelDescription !== null"
            ><i class="fa fa-info-circle"></i></a>
        </label>
    </div>
</label>
</template>

<script>
export default {
model : {
    prop: 'checked',
    event: 'toggle'
},
props: {
    checked: { required: true }, // model
    disabled: { default: false },
    field: { required: false },
    label: { required: true },
    labelDescription: { default: null },
    status: { default: '' }
},
data () {
    return { isChecked: this.checked !== undefined ? this.checked : false }
},
created () {
    if (this.field === undefined ) { this.id = Date.now() + '-' + Math.floor(Math.random()*1000) }
},
mounted () {
    if (this.labelDescription !== undefined) {
        $('a[title="' + this.labelDescription + '"]').tooltip()
    }
},
methods: {
    check () {
        this.isChecked = !this.isChecked
        this.$emit('toggle', this.isChecked)
        if ( this.checked !== undefined ) { this.$emit('autosave', this.$refs.input.name) }
    }
}

}
</script>

<style>
label.material-checkbox-group-label {
    font-weight: normal !important;
}
.clear-padding {
    padding-left: 0px!important;
    margin-right: 5px!important;
}
label.underline-animate:hover {
    font-style: italic;
}
.underline-animate:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0%;
    border-bottom: 3px solid #636b6f;
    transition: 0.4s;
}
.underline-animate:hover:after {
    width: 100%;
}
.material-checkbox-group-label {
    position: relative;
    display: block;
    cursor: pointer;
    height: 15px;
    line-height: 15px;
    padding-left: 20px; /* between control and label */ /*padding-left: 25px;*/
}
.material-checkbox-group-label:after { /*check marker*/
    content: "";
    display: block;
    width: 3px; /*width: 4px;*/
    height: 9px; /*height: 12px;*/
    opacity: .9;
    border-right: 2px solid #eee;
    border-top: 2px solid #eee;
    position: absolute;
    left: 3px; /*left: 4px;*/
    top: 9px; /*top: 12px;*/
    -webkit-transform: scaleX(-1) rotate(135deg);
    transform: scaleX(-1) rotate(135deg);
    -webkit-transform-origin: left top;
    transform-origin: left top;
}
.material-checkbox-group-label:before {
    content: "";
    display: block;
    border: 2px solid;
    width: 15px; /*width: 20px;*/
    height: 15px; /*height: 20px;*/
    position: absolute;
    left: 0;
}
.material-checkbox-group-label {
    /*font-size: 14px;*/
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
.material-checkbox:disabled ~ .material-checkbox-group-label { cursor: no-drop; }
.material-checkbox { display: none; }
.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {
    -webkit-animation: check 0.8s;
    animation: check 0.8s;
    opacity: 1;
}
.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #636b6f;
}
.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #eee;
}
.material-checkbox-group .material-checkbox-group-label:before {
    border-color: #636b6f;
}
.material-checkbox:disabled ~ .material-checkbox-group-label {
    color: #ccc;
}

.material-checkbox-group.primary {
    color: #4092d9;
}
.material-checkbox-group .material-checkbox-group-label.primary:before {
    border-color: #4092d9;
}
.underline-animate.primary:hover:after {
    border-bottom: 3px solid #4092d9;
}
.material-checkbox-group-primary .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #fff;
}
.material-checkbox-group-primary .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #4092d9;
}
.material-checkbox-group-primary .material-checkbox-group-label:before {
    border-color: #4092d9;
}

.material-checkbox-group.success {
    color: #68c368;
}
.material-checkbox-group .material-checkbox-group-label.success:before {
    border-color: #68c368;
}
.underline-animate.success:hover:after {
    border-bottom: 3px solid #68c368;
}
.material-checkbox-group-success .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #fff;
}
.material-checkbox-group-success .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #68c368;
}
.material-checkbox-group-success .material-checkbox-group-label:before {
    border-color: #68c368;
}

.material-checkbox-group.info {
    color: #8bdaf2;
}
.material-checkbox-group .material-checkbox-group-label.info:before {
    border-color: #8bdaf2;
}
.underline-animate.info:hover:after {
    border-bottom: 3px solid #8bdaf2;
}
.material-checkbox-group-info .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #fff;
}
.material-checkbox-group-info .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #8bdaf2;
}
.material-checkbox-group-info .material-checkbox-group-label:before {
    border-color: #8bdaf2;
}

.material-checkbox-group.warning {
    color: #f2a12e;
}
.material-checkbox-group .material-checkbox-group-label.warning:before {
    border-color: #f2a12e;
}
.underline-animate.warning:hover:after {
    border-bottom: 3px solid #f2a12e;
}
.material-checkbox-group-warning .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #fff;
}
.material-checkbox-group-warning .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #f2a12e;
}
.material-checkbox-group-warning .material-checkbox-group-label:before {
    border-color: #f2a12e;
}

.material-checkbox-group.danger {
    color: #f3413c;
}
.material-checkbox-group .material-checkbox-group-label.danger:before {
    border-color: #f3413c;
}
.underline-animate.danger:hover:after {
    border-bottom: 3px solid #f3413c;
}
.material-checkbox-group-danger .material-checkbox:checked + .material-checkbox-group-label:after {
    border-color: #fff;
}
.material-checkbox-group-danger .material-checkbox:checked + .material-checkbox-group-label:before {
    background-color: #f3413c;
}
.material-checkbox-group-danger .material-checkbox-group-label:before {
    border-color: #f3413c;
}

@-webkit-keyframes check {
    0% {
        height: 0;
        width: 0;
    }
    25% {
        height: 0;
        /*width: 4px;*/
        width: 3px;
    }
    50% {
        /*height: 12px;*/
        height: 9px;
        /*width: 4px;*/
        width: 3px;
    }
}
@keyframes check {
    0% {
        height: 0;
        width: 0;
    }
    25% {
        height: 0;
        /*width: 4px;*/
        width: 3px;
    }
    50% {
        /*height: 12px;*/
        height: 9px;
        /*width: 4px;*/
        width: 3px;
    }
}
</style>
