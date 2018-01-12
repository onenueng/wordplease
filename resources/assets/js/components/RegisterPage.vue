<template>
    <div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand hvr-shutter-out-vertical" href="/home">Wordplease</a>
                    <a class="navbar-brand active">Register<span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-sm-offset-3">
                <div class="page-header">
                    <h1>Register : 
                        <transition name="slide-fade">
                            <small v-show='showTextDisplay'>
                                {{ textDisplay }}
                                <i class="fa fa-circle-o-notch fa-spin"></i>
                            </small>
                        </transition>
                    </h1>
                </div>
                <div :class="divInputClass">
                    <input
                        type="text"
                        class="form-control"
                        v-model="userInput"
                        @input="isValidate()"
                        :placeholder="idName"
                        :disabled="idDisable" />
                    <span
                        v-show="showInputStateIcon"
                        :class="iconInputClass"
                        aria-hidden="true">
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            // field name on database.
            idName: {
                type: String,
                required: true
            },
            pattern: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                userInput: '',
                idDisable: null,
                textDisplay: '',
                divInputClass: 'form-group-sm has-feedback',
                iconInputClass: '',
                showTextDisplay: false,
                showInputStateIcon: false,
                userData: null
            }
        },
        methods: {
            isValidate() {
                
                if ( this.userInput.match(this.regex) !== null ) {
                    
                    this.showInputStateIcon = true
                    // this.iconInputClass = 'fa fa-circle-o-notch fa-spin form-control-feedback'
                    
                    this.textDisplay = "Looking for ID " + this.userInput
                    this.showTextDisplay = true
                    this.idDisable = ""

                    
                    this.checkId()
                    // return true
                } else {
                    console.log('id invalid')
                    // return false
                }
                
            },
            checkId() {
                axios.post('/check-id', {
                    org_id: this.userInput
                })
                .then( (response) => {
                    this.showTextDisplay = false
                    this.idDisable = null
                    this.userData = response.data
                    return true
                })
                .catch( (error) => {
                    this.showTextDisplay = false
                    this.idDisable = null
                    this.userData = null
                    console.log(error)
                    return false
                })
            }
        },
        computed: {
            regex() {
                if ( this.pattern !== null ) {
                    return new RegExp(this.pattern)
                }
                return null
            }
        }
    }
</script>

<style>
    @keyframes animateFader {
      0%   { opacity:1; }
      50%  { opacity:0; }
      100% { opacity:1; }
    }
    @-o-keyframes animateFader{
      0%   { opacity:1; }
      50%  { opacity:0; }
      100% { opacity:1; }
    }
    @-moz-keyframes animateFader{
      0%   { opacity:1; }
      50%  { opacity:0; }
      100% { opacity:1; }
    }
    @-webkit-keyframes animateFader{
      0%   { opacity:1; }
      50%  { opacity:0; }
      100% { opacity:1; }
    }
    .animate-fader {
       -webkit-animation: animateFader 1.5s infinite;
       -moz-animation: animateFader 1.5s infinite;
       -o-animation: animateFader 1.5s infinite;
        animation: animateFader 1.5s infinite;
    }

    .spinner {
        -animation: spin 2s infinite linear;
        -webkit-animation: spin2 2s infinite linear;
    }

    @-webkit-keyframes spin2 {
        from { -webkit-transform: rotate(0deg);}
        to { -webkit-transform: rotate(360deg);}
    }

    @keyframes spin {
        from { transform: scale(1) rotate(0deg);}
        to { transform: scale(1) rotate(360deg);}
    }
</style>
