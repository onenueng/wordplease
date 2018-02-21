<template>
    <div>
        <navbar link="/home"
                brand="Wordplease"
                title="Login">
        </navbar>

        <div class="container-fluid">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="page-header">
                    <h1>Login : </h1>
                </div>
                <div class="material-box-topic">
                    <form action="login" method="POST">
                        <div class="form-group">
                            <input type="text"
                                   name="org_id"
                                   class="form-control"
                                   placeholder="ID"
                                   autocomplete="off"
                                   v-model="userInputOrgId"
                                   @blur="hasId()"/>
                            <span class="help-block"><i class="text-danger">{{ orgIdHelpText }}</i></span>
                        </div>
                        <div class="form-group">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   v-model="userInputPassword"
                                   @blur="hasPassword()"/>
                            <span class="help-block"><i class="text-danger">{{ passwordHelpText }}</i></span>
                        </div>
                        <input type="hidden" name="_token" id="token" />
                        <input type="submit" id="submitLogin" style="display: none;" />
                    </form>
                    
                    <button-app
                        size="lg"
                        :label="loginButtonLabel"
                        action="login-click"
                        status="info">
                    </button-app>
                    
                    <transition
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInDown"
                        leave-active-class="animated fadeOutUp"
                      >
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
    export default {
        data() {
            return {
                userInputOrgId: '',
                userInputPassword: '',
                orgIdHelpText: '',
                passwordHelpText: '',
                loginButtonLabel: 'Login',
                alertContent: '',
                alertAnimated: '',
                alert: false
            }
        },
        mounted() {
            EventBus.$on('login-click', () => {
                if ( this.hasId() && this.hasPassword() ) {
                    this.loginButtonLabel = 'Logging in <i class="fa fa-circle-o-notch fa-spin"></i>'
                    axios.post('/js-login', {
                        org_id: this.userInputOrgId,
                        password: this.userInputPassword
                    })
                    .then( (response) => {
                        if ( response.data.reply_code == 0 ) {
                            $('#token').val(document.head.querySelector("[name=csrf-token]").content)
                            $('#submitLogin').click()
                        } else {
                            this.alertContent = response.data.reply_text
                            this.alert = true
                            setTimeout( () => {
                                this.alert = false
                            }, 5000);
                            this.loginButtonLabel = 'Login'
                        }
                    })
                    .catch( (error) => {
                        console.log(error)
                        this.loginButtonLabel = 'Login'
                    })
                }
            })
        },
        methods: {
            hasId() {
                if ( this.userInputOrgId != '' ) {
                    this.orgIdHelpText = ''
                    return true
                }
                this.orgIdHelpText = 'ID is required.'
                return false
            },
            hasPassword() {
                if ( this.userInputPassword != '' ) {
                    this.passwordHelpText = ''
                    return true
                }
                this.passwordHelpText = 'Password is required.'
                return false
            }
        }
    }
</script>