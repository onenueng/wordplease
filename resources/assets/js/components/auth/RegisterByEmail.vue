<template>
<div class="material-box-topic">
    <alert
        state="info"
        icon="fa fa-lightbulb-o fa-3x"
        animated="lightSpeedIn"
        content="The email register account is valid for a short period only, you will need Faculty's account to continue using this application.">
    </alert>
    <input-state
        name="email"
        label="Email :"
        pattern="email"
        service-url="/register/is-data-available"
        :disabled="disabled.email"
        v-model="user.email"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.email = isValid }"
    ></input-state>
    <input-state
        name="username"
        label="Username :"
        pattern="^\w+$"
        service-url="/register/is-data-available"
        placeholder-state-text="This will be your nickname for the app."
        :disabled="disabled.username"
        v-model="user.username"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.username = isValid }"
    ></input-state>
    <input-state
        type="password"
        name="password"
        label="Password :"
        :disabled="disabled.password"
        v-model="user.password"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.password = isValid }"
    ></input-state>
    <input-state
        type="password"
        name="re_password"
        label="Password again :"
        invalid-response-text="password doesn't matched"
        :pattern="'^' + user.password + '$'"
        :disabled="disabled.re_password"
        v-model="user.re_password"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.re_password = isValid }"
    ></input-state>
    <input-state
        name="full_name"
        label="Full Name in Thai :"
        pattern="[\u0e00-\u0e7e]"
        :disabled="disabled.full_name"
        v-model="user.full_name"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.full_name = isValid }"
    ></input-state>
    <input-state
        name="full_name_en"
        label="Full Name in English :"
        pattern="[a-zA-Z]"
        :disabled="disabled.full_name_en"
        v-model="user.full_name_en"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.full_name_en = isValid }"
    ></input-state>
    <transition name="slide-fade">
        <div class="form-group-sm" v-if="allDataValid">
            <button-app
                size="lg"
                status="info"
                :label="labelRegisterButton"
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
        Alert,
        ButtonApp,
        InputState
    },
    data() {
        return {

            labelRegisterButton: 'Register',

            user: {
                username: '',
                email: '',
                org_id: '',
                password: '',
                re_password: '',
                full_name: '',
                full_name_en: ''
            },
            valid: {
                username: false,
                email: false,
                password: false,
                re_password: false,
                full_name: false,
                full_name_en: false  
            },
            disabled: {
                username: false,
                email: false,
                password: false,
                re_password: false,
                full_name: false,
                full_name_en: false  
            }
        }
    },
    computed: {
        allDataValid () {
            let values = _.values(this.valid)
            return (_.sum(values) == values.length)
        }
    },
    methods: {
        registerButtonClicked() {
            this.idInputDisable = ''
            this.labelRegisterButton = 'Registering <i class="fa fa-circle-o-notch fa-spin"></i>'
            if ( this.allDataValid ) {
                
                let email = this.user.email
                console.log(email)
                let newUser = _.assign({org_id: email}, this.user)
                console.log(newUser)
                axios.post('/register', {
                    mode: "email",
                    user: newUser
                    // user: {
                    //     name: this.username,
                    //     email: this.email,
                    //     org_id: this.email,
                    //     password: this.password,
                    //     full_name: this.full_name,
                    //     full_name_en: this.full_name_en
                    // }
                })
                .then( (response) => {
                    window.location.href = response.data.href
                })
                .catch( (error) => {
                    this.labelRegisterButton = 'Register'
                    this.disabled = _.mapValues(this.disabled, () => false);
                    this.$emit('error', error)
                })
            }
        }
    }
}
</script>
