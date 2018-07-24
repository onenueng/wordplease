<template>
    <div>
        <modal-dialogue :toggle="modalDialogueToggle"
                        :heading="modalDialogueHeading"
                        :message="modalDialogueMessage"
                        :buttonLabel="modalDialogueButtonLabel"
                        @modalDialogueDismiss="modalDialogueToggle = 'hide'"
        ></modal-dialogue>

        <navbar link="/home"
                brand="Wordplease"
                title="Login">
                <navbar-left slot="navbar-left"></navbar-left>
                <navbar-right slot="navbar-right"></navbar-right>
        </navbar>

        <div class="container-fluid">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="page-header">
                    <h1>Login : </h1>
                </div>
                <div class="material-box-topic">
                    <form ref="form"
                          method="POST"
                          action="/login"
                          @keydown="errors[$event.target.name] = false"
                          @keydown.enter.prevent="loginButtonClicked">
                        <div class="form-group">
                            <input type="text"
                                   name="org_id"
                                   class="form-control"
                                   placeholder="ID"
                                   autocomplete="off"
                                   v-model="org_id"/>
                            <span class="help-block" v-if="errors.org_id">
                                <i class="text-danger">ID is required.</i>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   v-model="password"/>
                            <span class="help-block" v-if="errors.password">
                                <i class="text-danger">Password is required.</i>
                            </span>
                        </div>

                        <input type="hidden" name="_token" ref="token" />
                    </form>

                    <button-app size="lg"
                                status="info"
                                :disable='loggingIn'
                                :label="loginButtonLabel"
                                @click="loginButtonClicked"
                    ></button-app>

                    <a href="/register" v-if="!loggingIn">Or register a new one</a>

                    <transition name="custom-classes-transition"
                                enter-active-class="animated fadeInDown"
                                leave-active-class="animated fadeOutUp">
                        <alert state="danger"
                               icon="fa fa-remove fa-3x"
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
    import Alert from '../components/alerts/Alert.vue'
    import Navbar from '../components/navbars/Navbar.vue'
    import ButtonApp from '../draft/ButtonApp.vue'
    import ModalDialogue from '../draft/ModalDialogue.vue'
    import NavbarLeft from '../components/navbars/NavbarLeft.vue'
    import NavbarRight from '../components/navbars/NavbarRight.vue'

    // utilities
    import ResponseErrorHandler from '../sandbox/ResponseErrorHandler.js'
    import watermark from "../modules/page-text-watermark.js"
    import formHelper from "../modules/form-helper.js"

    export default {
        components: {
            Alert,
            Navbar,
            ButtonApp,
            NavbarLeft,
            NavbarRight,
            ModalDialogue
        },
        mounted () {
            formHelper.loaded()
            watermark.watermark('koramit@gmail.com')
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
                loginButtonLabel: 'Login',
                
                caught: {}
            }
        },
        methods: {
            hasError (field) {
                return this.errors[field] = this[field] == ''
            },

            loginButtonClicked () {
                if ( !this.hasError('org_id') & !this.hasError('password') ) {
                    this.loggingIn = true
                    this.loginButtonLabel = 'Logging in <i class="fa fa-circle-o-notch fa-spin"></i>'
                    axios.post('/front-end-login', {
                        org_id: this.org_id,
                        password: this.password
                    })
                    .then( (response) => {
                        if ( response.data.reply_code == 0 ) {
                            this.$refs.token.value = document.head.querySelector("[name=csrf-token]").content
                            this.$refs.submit()
                        } else {
                            this.alertContent = response.data.reply_text
                            this.alert = true
                            setTimeout( () => {
                                this.alert = false
                            }, 5000);
                            this.loginButtonLabel = 'Login'
                            this.loggingIn = false
                        }
                    })
                    .catch( (error) => {
                        this.loginButtonLabel = 'Login'
                        this.loggingIn = false
                        this.caught = new ResponseErrorHandler(error)
                        this.caught.handle()
                    })
                }
            }
        }
    }
</script>
