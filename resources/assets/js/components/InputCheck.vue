<template>
    <!-- 
    <label class="checkbox-inline underline-animate">
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
 -->
    <label class="checkbox-inline underline-animate clear-padding">
        <div class="material-checkbox-group">
            <input  type="checkbox"
                    class="material-checkbox"
                    :id="field"
                    :name="field"
                    :checked="thisChecked"
                    @click="check()"/>
            <label  class="material-checkbox-group-label"
                    :for="field">
                {{ label }}
                <a  v-if="labelDescription !== undefined"
                    role="button"
                    data-toggle="tooltip"
                    :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
            </label>
        </div>
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
            emitOnUpdate: {
                
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
                    if (value != this.thisChecked) {
                        this.thisChecked = value
                        this.autosave()
                    }
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
                
                this.autosave()

                if (this.emitOnUpdate !== undefined) {
                    (this.emitEvents).forEach((event) => {
                        // [name][mode 1:checked 2:unchecked][value]
                        if (event[1] == this.thisChecked) {
                            EventBus.$emit(event[0], event[2])
                        }    
                    })
                }
            },
            autosave() {
                if (this.field !== undefined)
                    EventBus.$emit('autosave', this.field, (this.thisChecked.length > 0))
            }
        },
        computed: {
            emitEvents() {
                if (typeof this.emitOnUpdate == 'String') {
                    return JSON.parse(this.emitOnUpdate)
                }
                return this.emitOnUpdate
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
        /*padding-left: 25px;*/
        padding-left: 20px; /* between control and label */
    }

    .material-checkbox-group-label:after { /*check marker*/
        content: "";
        display: block;
        /*width: 4px;*/
        width: 3px;
        /*height: 12px;*/
        height: 9px;
        opacity: .9;
        border-right: 2px solid #eee;
        border-top: 2px solid #eee;
        position: absolute;
        /*left: 4px;*/
        left: 3px;
        /*top: 12px;*/
        top: 9px;
        -webkit-transform: scaleX(-1) rotate(135deg);
        transform: scaleX(-1) rotate(135deg);
        -webkit-transform-origin: left top;
        transform-origin: left top;
    }

    .material-checkbox-group-label:before {
        content: "";
        display: block;
        border: 2px solid;
        /*width: 20px;*/
        width: 15px;
        /*height: 20px;*/
        height: 15px;
        position: absolute;
        left: 0;
    }

    .material-checkbox-group-label {
        /*font-size: 14px;*/
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .material-checkbox:disabled ~ .material-checkbox-group-label {
        cursor: no-drop;
    }

    .material-checkbox {
        display: none;
    }

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
        color: #eee;
    }

    .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:after {
        border-color: #fff;
    }

    .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:before {
        background-color: #4092d9;
    }

    .material-checkbox-group_primary .material-checkbox-group-label:before {
        border-color: #4092d9;
    }

    .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:after {
        border-color: #fff;
    }

    .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:before {
        background-color: #68c368;
    }

    .material-checkbox-group_success .material-checkbox-group-label:before {
        border-color: #68c368;
    }

    .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:after {
        border-color: #fff;
    }

    .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:before {
        background-color: #8bdaf2;
    }

    .material-checkbox-group_info .material-checkbox-group-label:before {
        border-color: #8bdaf2;
    }

    .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:after {
        border-color: #fff;
    }

    .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:before {
        background-color: #f2a12e;
    }

    .material-checkbox-group_warning .material-checkbox-group-label:before {
        border-color: #f2a12e;
    }

    .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:after {
        border-color: #fff;
    }

    .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:before {
        background-color: #f3413c;
    }

    .material-checkbox-group_danger .material-checkbox-group-label:before {
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
