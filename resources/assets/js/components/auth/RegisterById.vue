<template><form action="/register" method="post" name="register">
<div class="material-box-topic">
    <alert
        state="info"
        icon="fa fa-lightbulb-o fa-3x"
        animated="lightSpeedIn"
        content="You need Faculty's account to register and login by ID. If you don't have one, you will not be able to login the application."
    ></alert>

    <csrf-token/>
    <input type="hidden" name="mode" value="id">
    <input type="hidden" name="user" :value="JSON.stringify(user)">

    <input-state
        name="org_id"
        service-url="/register/is-data-available"
        placeholder-state-text="please fill in a valid ID"
        :label="idName"
        :pattern="pattern"
        v-model="orgId"
        @error="(error) => { $emit('error', error) }"
        @validated="orgIdValidate"
    ></input-state>
    <transition name="slide-fade">
        <div v-if="user != null">
            <div class="form-group-sm">
                <label class="control-label topped">Full Name :</label>
                <input type="text" class="form-control" v-model="user.full_name" readonly />
            </div>
            <div class="form-group-sm">
                <label class="control-label topped">Position :</label>
                <input type="text" class="form-control" v-model="user.org_position_title" readonly />
            </div>
            <div class="form-group-sm">
                <label class="control-label topped">Division :</label>
                <input type="text" class="form-control" v-model="user.org_division_name" readonly />
                <span class="help-block">
                    <i>In case of above fields are incorrect, please contact HR department.</i>
                </span>
            </div>
            <hr class="line">
            <input-state
                name="email"
                label="Email :"
                pattern="email"
                service-url="/register/is-data-available"
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
                v-model="user.name"
                @error="(error) => { $emit('error', error) }"
                @validated="(isValid) => { valid.name = isValid }"
            ></input-state>
            <input-state
                name="name_en"
                label="Full Name in English :"
                pattern="[a-zA-Z]"
                v-model="user.full_name_en"
                @error="(error) => { $emit('error', error) }"
                @validated="(isValid) => { valid.full_name_en = isValid }"
            ></input-state>
            <hr class="line">
        </div>
    </transition>
    <transition name="slide-fade">
        <div class="form-group-sm" v-if="valid.email && valid.name && valid.full_name_en">
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
        props: {
            idName: { default: 'SAP ID' },
            pattern: { default: '.' }
        },
        data() {
            return {
                orgId: null,
                user: null,
                valid: {
                    email: false,
                    name: false,
                    full_name_en: false
                },
                labelRegisterButton: "Register"
            }
        },
        methods: {
            orgIdValidate (available, payload) {
                if ( available ) {
                    this.user = payload
                } else {
                    this.user = null
                }
            }
        }
    }
</script>
