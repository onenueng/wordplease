<template>
<div class="material-box-topic">
    <alert
        state="info"
        icon="fa fa-lightbulb-o fa-3x"
        animated="lightSpeedIn"
        content="The email register account is valid for a short period only, you will need Faculty's account to continue using this application.">
    </alert>
    <input-state
        field="email"
        service-url="/register/is-data-available"
        label="Email :"
        pattern="email"
        :input-value.sync="email"
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
    <div :class="passwordDivClass">
        <label class="control-label">Password :</label>
        <input type="password" class="form-control" @input="repasswordUpdated()" v-model="password" />
        <span :class="passwordIconClass"></span>
        <span class="help-block"><i>{{ passwordHelpText }}</i></span>
    </div>
    <div :class="passwordDivClass">
        <label class="control-label">Password again :</label>
        <input type="password" class="form-control" @input="repasswordUpdated()" v-model="re_password" />
        <span :class="passwordIconClass"></span>
        <span class="help-block"><i>{{ passwordHelpText }}</i></span>
    </div>
    <input-state
        field="full_name"
        label="Full Name in Thai :"
        pattern="[\u0e00-\u0e7e]"
        :input-value.sync="full_name"
        :is-valid.sync="isFullNameValid"
        :input-disable="idInputDisable">
    </input-state>
    <input-state
        field="full_name_en"
        label="Full Name in English :"
        pattern="[a-zA-Z]"
        :input-value.sync="full_name_en"
        :is-valid.sync="isFullNameEnValid"
        :input-disable="idInputDisable">
    </input-state>

    <transition name="slide-fade">
        <div class="form-group-sm" v-if="allDataValid">
            <button-app
                size="lg"
                :label="labelRegisterButton"
                action="email-register-click"
                status="info">
            </button-app>
        </div>
    </transition>
</div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            isEmailValid: false,
            username: "",
            isUsernameValid: false,
            full_name: "",
            isFullNameValid: false,
            full_name_en: "",
            isFullNameEnValid: false,
            password: "",
            re_password: "",
            passwordHelpText: null,
            passwordDivClass: 'form-group-sm has-feedback',
            passwordIconClass: 'form-control-feedback',
            labelRegisterButton: "Register",
            idInputDisable: null
        }
    },
    mounted() {
        EventBus.$on('email-register-click', () => {
            this.idInputDisable = ''
            this.labelRegisterButton = 'Registering <i class="fa fa-circle-o-notch fa-spin"></i>'
            if ( this.allDataValid ) {
                axios.post('/register', {
                    mode: "email",
                    user: {
                        name: this.username,
                        email: this.email,
                        org_id: this.email,
                        password: this.password,
                        full_name: this.full_name,
                        full_name_en: this.full_name_en
                    }
                })
                .then( (response) => {
                    window.location.href = response.data.href
                    this.idInputDisable = null
                    this.labelRegisterButton = 'Register'
                })
                .catch( (error) => {
                    console.log(error)
                    this.idInputDisable = null
                    this.labelRegisterButton = 'Register'
                })
            }
        })

        this.repasswordUpdated = _.debounce(() => {
            this.checkPasswordMatched()
        }, 800)
    },
    methods: {
        checkPasswordMatched() {
            this.passwordHelpText = null
            if ( ( this.password == '' ) || ( this.re_password == '' ) ) {
                this.passwordDivClass = 'form-group-sm has-feedback'
                this. passwordIconClass = 'form-control-feedback'
            } else if ( this.password == this.re_password ) {
                this.passwordDivClass = 'form-group-sm has-success has-feedback'
                this. passwordIconClass = 'fa fa-check form-control-feedback'
            } else {
                this.passwordDivClass = 'form-group-sm has-error has-feedback'
                this. passwordIconClass = 'fa fa-remove form-control-feedback'
                this.passwordHelpText = 'password and password again not matched'
            }
        }
    },
    computed: {
        allDataValid() {
            return this.isEmailValid &&
                   this.isUsernameValid &&
                   this.isFullNameValid &&
                   this.isFullNameEnValid &&
                   (this.re_password != '') &&
                   (this.password == this.re_password)
        }
    }
}
</script>
