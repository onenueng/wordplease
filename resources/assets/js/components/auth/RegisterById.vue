<template>
<div class="material-box-topic">
    <alert
        state="info"
        icon="fa fa-lightbulb-o fa-3x"
        animated="lightSpeedIn"
        content="You need Faculty's account to register and login by ID. If you don't have one, you will not be able to login the application."
    ></alert>
    <input-state
        name="org_id"
        service-url="/register/is-data-available"
        placeholder-state-text="please fill in a valid ID"
        :label="idName"
        :pattern="pattern"
        :disabled="disabled.orgId"
        v-model="orgId"
        @disabled="(state) => { disabled.orgId = state }"
        @error="(error) => { $emit('error', error) }"
        @validated="orgIdValidate"
    ></input-state>
    <transition name="slide-fade">
        <div v-if="userData != null">
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
                name="email"
                label="Email :"
                pattern="email"
                service-url="/register/is-data-available"
                :disabled="disabled.email"
                v-model="userData.email"
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
                v-model="userData.username"
                @error="(error) => { $emit('error', error) }"
                @validated="(isValid) => { valid.username = isValid }"
            ></input-state>
            <input-state
                name="name_en"
                label="Full Name in English :"
                pattern="[a-zA-Z]"
                :disabled="disabled.name_en"
                v-model="userData.name_en"
                @error="(error) => { $emit('error', error) }"
                @validated="(isValid) => { valid.name_en = isValid }"
            ></input-state>
            <hr class="line">
        </div>
    </transition>
    <transition name="slide-fade">
        <div class="form-group-sm" v-if="valid.email && valid.username && valid.name_en">
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
        props: {
            idName: { default: 'SAP ID' },
            pattern: { default: '^100([0-9]{5})$' }
        },
        data() {
            return {
                orgId: null,
                userData: null,
                valid: {
                    email: false,
                    username: false,
                    name_en: false
                },
                disabled: {
                    orgId: false,
                    email: false,
                    username: false,
                    name_en: false
                },                
                labelRegisterButton: "Register"
            }
        },
        computed: {
            regex() {
                return new RegExp(this.pattern)
            }
        },
        methods: {
            orgIdValidate (available, payload) {
                if ( available ) {
                    this.userData = payload
                } else {
                    this.userData = null
                }
            },
            registerButtonClicked() {
                this.disabled = _.mapValues(this.disabled, () => true);

                this.labelRegisterButton = 'Registering <i class="fa fa-circle-o-notch fa-spin"></i>'

                axios.post('/register', {
                    mode: "id",
                    user: {
                        name: this.userData.username,
                        email: this.userData.email,
                        org_id: this.userData.org_id,
                        full_name: this.userData.name,
                        full_name_en: this.userData.name_en
                    }
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
</script>
