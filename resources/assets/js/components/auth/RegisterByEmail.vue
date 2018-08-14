<template><form action="/register" method="post" name="register">
<div class="material-box-topic">
    <alert
        animated="lightSpeedIn"
        content="The email register account is valid for a short period only, you will need Faculty's account to continue using this application."
        icon="fa fa-lightbulb-o fa-3x"
        state="info"
    ></alert>

    <csrf-token/>
    <input type="hidden" name="mode" value="email" />
    <input type="hidden" name="user" :value="JSON.stringify(user)" />

    <input-state
        field="email"
        label="Email :"
        pattern="email"
        service-url="/register/is-data-available"
        v-model="user.email"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.email = isValid }"
    ></input-state>
    <input-state
        field="username"
        label="Username :"
        pattern="^\w+$"
        service-url="/register/is-data-available"
        placeholder-state-text="This will be your nickname for the app."
        v-model="user.name"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.name = isValid }"
    ></input-state>
    <input-state
        field="password"
        label="Password :"
        type="password"
        v-model="user.password"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.password = isValid }"
    ></input-state>
    <input-state
        field="re_password"
        invalid-response-text="password doesn't matched"
        label="Password again :"
        type="password"
        :pattern="'^' + user.password + '$'"
        v-model="user.re_password"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.re_password = isValid }"
    ></input-state>
    <input-state
        field="full_name"
        label="Full Name in Thai :"
        pattern="[\u0e00-\u0e7e]"
        v-model="user.full_name"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.full_name = isValid }"
    ></input-state>
    <input-state
        field="full_name_en"
        label="Full Name in English :"
        pattern="[a-zA-Z]"
        v-model="user.full_name_en"
        @error="(error) => { $emit('error', error) }"
        @validated="(isValid) => { valid.full_name_en = isValid }"
    ></input-state>
    <hr class="line">
    <transition name="slide-fade">
        <div class="form-group-sm" v-if="allDataValid">
            <button-app
                size="lg"
                status="info"
                :label="labelRegisterButton"
                @click="document.forms.register.submit()"
            ></button-app>
        </div>
    </transition>
</div>
</form></template>

<script>
import Alert from '../alerts/Alert.vue'
import CsrfToken from '../forms/CsrfToken.vue'
import ButtonApp from '../buttons/ButtonApp.vue'
import InputState from '../inputs/InputState.vue'

export default {
    components: {
        Alert,
        CsrfToken,
        ButtonApp,
        InputState
    },
    data() {
        return {

            labelRegisterButton: 'Register',

            user: {
                name: null,
                email: null,
                org_id: null,
                password: null,
                re_password: null,
                full_name: null,
                full_name_en: null
            },
            valid: {
                name: false,
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
    }
}
</script>
