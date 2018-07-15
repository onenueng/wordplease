<template>
    <div>
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
                    <form
                        ref="form"
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
                                   v-model="org_id"
                                   @blur=""/>
                            <span class="help-block" v-if="errors.org_id">
                                <i class="text-danger">ID is required.</i>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   v-model="password"
                                   @blur=""/>
                            <span class="help-block" v-if="errors.password">
                                <i class="text-danger">Password is required.</i>
                            </span>
                        </div>

                        <input type="hidden" name="_token" ref="token" />
                    </form>

                    <button-app
                        size="lg"
                        status="info"
                        :disable='loggingIn'
                        :label="loginButtonLabel"
                        @click="loginButtonClicked"
                    ></button-app>

                    <a href="/register" v-if="!loggingIn">Or register a new one</a>

                    <transition
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInDown"
                        leave-active-class="animated fadeOutUp">
                        <alert
                            state="danger"
                            icon="fa fa-remove fa-3x"
                            :content="alertContent"
                            v-if="alert">
                        </alert>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Alert from '../components/alerts/Alert.vue'
    import Navbar from '../components/navbars/Navbar.vue'
    import ResponseErrorHandler from '../sandbox/ResponseErrorHandler.js'
    import ButtonApp from '../draft/ButtonApp.vue'
    import NavbarLeft from '../components/navbars/NavbarLeft.vue'
    import NavbarRight from '../components/navbars/NavbarRight.vue'

    export default {
        components: {
            Alert,
            Navbar,
            ButtonApp,
            NavbarLeft,
            NavbarRight,
        },
        data() {
            return {
                org_id: '',
                password: '',
                errors: {
                    org_id: false,
                    password: false
                },
                loggingIn: false,
                loginButtonLabel: 'Login',
                alert: false,
                alertContent: '',
                alertAnimated: '',
                caught: {}
            }
        },
        methods: {
            hasError(field) {
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
                            this.$refs.toekn.value = document.head.querySelector("[name=csrf-token]").content
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
