<template>
<div>
    <div :class="divIdInputClass">
        <label for="orgId" class="control-label">
            {{ idName }} : 
        </label>
        <input
            id="orgId"
            type="text"
            class="form-control"
            @input="idUpdate()"
            @focus="idFocus()"
            v-model="userInput"
            :disabled="idInputDisable"
            autocomplete="off" />
        <span
            v-show="showIdInputStateIcon"
            :class="idInputStateIconClass"
            aria-hidden="true">
        </span>
        <span class="help-block">{{ idStateText }}</span>
    </div>
    <transition name="slide-fade">
        <div v-if="showUserData">
            <div class="form-group-sm">
                <label class="control-label">Name :</label>
                <input type="text" class="form-control" v-model="userData.name" readonly />
            </div>
            <div class="form-group-sm">
                <label class="control-label">Position :</label>
                <input type="text" class="form-control" v-model="userData.org_position_title" readonly />
            </div>
            <div class="form-group-sm">
                <label class="control-label">Division :</label>
                <input type="text" class="form-control" v-model="userData.org_division_name" readonly />
                <span class="help-block"><i>In case of above fields are incorrect, please contact HR department.</i></span>
            </div>
            <hr class="line">
            <input-state
                field="email"
                service-url="/register/is-data-available"
                label="Email :"
                pattern="email">
            </input-state>
            <input-state
                field="username"
                service-url="/register/is-data-available"
                label="Username :"
                pattern="^\w+$"
                init-help-text="This nickname will display in the app.">
            </input-state>
        </div>
    </transition>
</div>
</template>

<script>
    export default {
        props: {
            idName: {
                type: String,
                required: true
            },
            pattern: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                divIdInputClass: 'form-group-sm has-feedback',
                userInput: null,
                idInputDisable: null,
                showIdInputStateIcon: false,
                idInputStateIconClass: '',
                idStateText: null,
                userData: '',
                showUserData: false
            }
        },
        computed: {
            regex() {
                if ( this.pattern !== null ) {
                    return new RegExp(this.pattern)
                }
                return null
            }
        },
        methods: {
            idUpdate() {
                if ( this.isIdValid() ) {
                    this.idInputDisable = ''
                    this.idInputStateIconClass = 'fa fa-circle-o-notch fa-spin form-control-feedback'
                    this.showIdInputStateIcon = true
                    this.checkId()
                } else {
                    this.showUserData = false
                }
            },
            isIdValid() {
                if ( this.userInput.match(this.regex) !== null ) {
                    return true
                }
                return false
            },
            idFocus() {
                this.showIdInputStateIcon = false
                this.idStateText = ''
                this.divIdInputClass = 'form-group-sm has-feedback'
            },
            checkId() {
                axios.post('/register/check-id', {
                    org_id: this.userInput
                })
                .then( (response) => {
                    this.divIdInputClass = 'form-group-sm has-feedback has-' + response.data.state
                    this.idInputStateIconClass = 'glyphicon form-control-feedback glyphicon-' + response.data.icon
                    if (response.data.reply_code > 0) {
                        this.idStateText = response.data.reply_text
                    } else {
                        this.idStateText = ''
                        this.userData = response.data
                        this.showUserData = true
                    }
                    this.idInputDisable = null
                })
                .catch( (error) => {
                    this.divIdInputClass = 'form-group-sm has-feedback has-error'
                    this.idInputStateIconClass = 'glyphicon glyphicon-remove form-control-feedback'
                    this.idStateText = 'Whoops, someting went wrong. Please try again.'
                    this.idInputDisable = null
                    console.log(error)
                })
            }
        }
    }
</script>
