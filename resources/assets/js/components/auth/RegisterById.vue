<template>
<div class="material-box-topic">
    <alert
        state="info"
        icon="fa fa-lightbulb-o fa-3x"
        animated="lightSpeedIn"
        content="You need Faculty's account to register and login by ID. If you don't have one, you will not be able to login the application.">
    </alert>
    <div :class="divIdInputClass">
        <label for="orgId" class="control-label">
            {{ idName }} :
        </label>
        <input
            id="orgId"
            type="text"
            class="form-control"
            @input="idUpdate"
            @focus="idFocus"
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
                <label class="control-label">Full Name :</label>
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
                pattern="email"
                :input-value.sync="userData.email"
                :is-valid.sync="isEmailValid"
                :input-disable="idInputDisable">
            </input-state>
            <input-state
                field="username"
                service-url="/register/is-data-available"
                label="Username :"
                pattern="^\w+$"
                init-help-text="This nickname will display in the app."
                :input-value.sync="username"
                :is-valid.sync="isUsernameValid"
                :input-disable="idInputDisable">
            </input-state>
            <input-state
                field="name_en"
                label="Full Name in English :"
                pattern="[a-zA-Z]"
                :input-value.sync="userData.name_en"
                :is-valid.sync="isNameEnValid"
                :input-disable="idInputDisable">
            </input-state>
            <hr class="line">
        </div>
    </transition>
    <transition name="slide-fade">
        <div class="form-group-sm" v-if="isEmailValid && isUsernameValid && isNameEnValid">
            <button-app
                size="lg"
                :label="labelRegisterButton"
                status="info"
                @click="registerButtonClicked"
            ></button-app>
        </div>
    </transition>
</div>
</template>

<script>
    import Alert from '../alerts/Alert.vue'
    import ButtonApp from '../buttons/ButtonApp.vue'
    import InputState from '../inputs/InputState.vue'

    export default {
        components: {
            'alert': Alert,
            'button-app': ButtonApp,
            'input-state': InputState
        },
        props: {
            idName: { default: 'SAP ID' },
            pattern: { default: '^100([0-9]{5})$' }
        },
        data() {
            return {
                divIdInputClass: 'form-group-sm has-feedback',
                userInput: null,
                idInputDisable: null,
                showIdInputStateIcon: false,
                idInputStateIconClass: '',
                initIdStateText: "please fill in a valid ID",
                idStateText: null,
                userData: '',
                showUserData: false,
                isEmailValid: false,
                username: '',
                isUsernameValid: false,
                isNameEnValid: false,
                labelRegisterButton: "Register"
            }
        },
        computed: {
            regex() {
                return new RegExp(this.pattern)
            }
        },
        methods: {
            idUpdate() {
                if ( this.userInput.match(this.regex) !== null ) {
                    this.idStateText = null
                    this.idInputDisable = ''
                    this.showIdInputStateIcon = true
                    this.idInputStateIconClass = 'fa fa-circle-o-notch fa-spin form-control-feedback'
                    this.checkId()
                } else {
                    this.showUserData = false
                    this.isUsernameValid = false
                    this.isEmailValid = false
                    this.isNameEnValid = false
                }
            },
            isIdValid() {
                return ( this.userInput.match(this.regex) !== null )
            },
            idFocus() {
                this.showIdInputStateIcon = false
                this.idStateText = this.initIdStateText
                this.divIdInputClass = 'form-group-sm has-feedback'
            },
            checkId() {
                axios.post('/register/check-ido', {
                    org_id: this.userInput
                })
                .then( (response) => {
                    this.divIdInputClass = 'form-group-sm has-feedback has-' + response.data.state
                    this.idInputStateIconClass = 'glyphicon form-control-feedback glyphicon-' + response.data.icon
                    if (response.data.reply_code > 0) {
                        this.idStateText = response.data.reply_text
                    } else {
                        this.idStateText = null
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
                    // if ( error.response.status == 404 ) { alert(typeof error) }
                    // console.log(error)
                    this.$emit('error', error)
                })
            },
            registerButtonClicked() {
                this.idInputDisable = ''
                this.labelRegisterButton = 'Registering <i class="fa fa-circle-o-notch fa-spin"></i>'
                if ( this.isEmailValid && this.isUsernameValid && this.isNameEnValid ) {
                    axios.post('/register', {
                        mode: "id",
                        user: {
                            name: this.username,
                            email: this.userData.email,
                            org_id: this.userData.org_id,
                            full_name: this.userData.name,
                            full_name_en: this.userData.name_en
                        }
                    })
                    .then( (response) => {
                        window.location.href = response.data.href
                        this.idInputDisable = null
                        this.labelRegisterButton = 'Register'
                    })
                    .catch( (error) => {
                        this.idInputDisable = null
                        this.labelRegisterButton = 'Register'
                        this.$emit('error', error)
                    })
                }
            }
        }
    }
</script>
