<template>
<div>
    <modal-dialogue
        :toggle="modalDialogueToggle"
        :heading="modalDialogueHeading"
        :message="modalDialogueMessage"
        :buttonLabel="modalDialogueButtonLabel"
        @modalDialogueDismiss="modalDialogueToggle = false" />
    <navbar 
        :brand="{ link: '/home', title: 'Wordplease', subTitle: 'Login' }">
        <navbar-left slot="navbar-left"></navbar-left>
        <navbar-right slot="navbar-right"></navbar-right>
    </navbar>
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="page-header">
                <h1>Login : </h1>
            </div>
            <div class="material-box-topic">
                <form
                    action="/login"
                    method="POST"
                    ref="form"
                    @keydown="errors[$event.target.name] = false"
                    @keydown.enter.prevent="loginButtonClicked">
                    <div class="form-group">
                        <input
                            autocomplete="off"
                            class="form-control"
                            name="org_id"
                            placeholder="ID"
                            type="text"
                            v-model="org_id"/>
                        <span
                            class="help-block"
                            v-if="errors.org_id"
                        ><i class="text-danger">ID is required.</i></span>
                    </div>
                    <div class="form-group">
                        <input
                            class="form-control"
                            name="password"
                            placeholder="Password"
                            type="password"
                            v-model="password"/>
                        <span
                            class="help-block"
                            v-if="errors.password"
                        ><i class="text-danger">Password is required.</i></span>
                    </div>
                </form>

                <button-app
                    size="lg"
                    status="info"
                    :disable='loggingIn'
                    :label="loginButtonLabel"
                    @click="loginButtonClicked"
                ></button-app>

                <a  href="/register"
                    v-if="!loggingIn"
                >Or register a new one</a>

                <transition
                    name="custom-classes-transition"
                    enter-active-class="animated fadeInDown"
                    leave-active-class="animated fadeOutUp">
                    <alert
                        icon="fa fa-remove fa-3x"
                        state="danger"
                        :content="alertContent"
                        v-if="alert"
                    ></alert>
                </transition>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// components
import Alert from '../alerts/Alert.vue'
import Navbar from '../navbars/Navbar.vue'
import NavbarLeft from '../navbars/NavbarLeft.vue'
import NavbarRight from '../navbars/NavbarRight.vue'
import ButtonApp from '../buttons/ButtonApp.vue'
import ModalDialogue from '../modals/ModalDialogue.vue'

// utilities
import formHelper from "../../modules/form-helper.js"

export default {
    components: {
        Alert,
        Navbar,
        ButtonApp,
        NavbarLeft,
        NavbarRight,
        ModalDialogue
    },
    data() {
        return {
            alert: false,
            alertContent: '',
            alertAnimated: '',

            modalDialogueToggle: undefined,
            modalDialogueHeading: undefined,
            modalDialogueMessage: undefined,
            modalDialogueButtonLabel: undefined,

            org_id: '',
            password: '',
            errors: {
                org_id: false,
                password: false
            },
            loggingIn: false,
            loginButtonLabel: 'Login'
        }
    },
    mounted () {
        formHelper.loaded()
    },
    methods: {
        hasError (field) {
            return this.errors[field] = this[field] == ''
        },

        loginButtonClicked () {
            if ( !this.hasError('org_id') & !this.hasError('password') ) {
                this.loggingIn = true
                this.loginButtonLabel = 'Logging in <i class="fa fa-circle-o-notch fa-spin"></i>'
                axios.post('/api-login', {
                    org_id: this.org_id,
                    password: this.password
                })
                .then( (response) => {
                    if ( response.data.reply_code == 0 ) {
                        window.location.href = response.data.reply_text
                    } else {
                        this.alertContent = response.data.reply_text
                        this.alert = true
                        setTimeout( () => {
                            this.alert = false
                        }, 5000)
                        this.loginButtonLabel = 'Login'
                        this.loggingIn = false
                    }
                })
                .catch( (error) => {
                    this.loginButtonLabel = 'Login'
                    this.loggingIn = false
                    formHelper.responseErrorHandle(error)
                })
            }
        }
    }
}
</script>
