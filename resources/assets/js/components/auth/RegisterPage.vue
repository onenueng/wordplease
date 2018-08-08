<template>
    <div>
        <modal-dialogue :toggle="modalDialogueToggle"
                        :heading="modalDialogueHeading"
                        :message="modalDialogueMessage"
                        :buttonLabel="modalDialogueButtonLabel"
                        @modalDialogueDismiss="modalDialogueToggle = false" />
        <navbar
            :brand="{ link: '/home', title: 'Wordplease', subTitle: 'Register' }">
            <navbar-left slot="navbar-left" />
            <navbar-right slot="navbar-right" />
        </navbar>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="page-header">
                    <h1>Register : </h1>
                </div>
                <div class="form-inline">
                    <div class="form-group-sm">
                        <label class="control-label" for="">Register by :</label>
                        <label class="radio-inline">
                            <input name="register_by" type="radio" @click="showForm('id')" /> SAP ID
                        </label>
                        <label class="radio-inline">
                            <input name="register_by" type="radio" @click="showForm('email')" /> Email
                        </label>
                    </div>
                </div>
                <hr class="line">
                <div v-if="showRegisterById">
                    <register-by-id
                        id-name="SAP ID"
                        :pattern="orgIdPattern"
                        @error="handleError" />
                </div>

                <div v-if="showRegisterByEmail">
                    <register-by-email @error="handleError" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from '../../components/navbars/Navbar.vue'
    import NavbarLeft from '../../components/navbars/NavbarLeft.vue'
    import RegisterById from '../../components/auth/RegisterById.vue'
    import NavbarRight from '../../components/navbars/NavbarRight.vue'
    import RegisterByEmail from '../../components/auth/RegisterByEmail.vue'
    import ModalDialogue from '../modals/ModalDialogue.vue'

    import formHelper from "../../modules/form-helper.js"

    export default {
        components: {
            Navbar,
            NavbarLeft,
            NavbarRight,
            RegisterById,
            ModalDialogue,
            RegisterByEmail
        },
        data () {
            return {
                showRegisterById: false,
                showRegisterByEmail: false,

                modalDialogueToggle: undefined,
                modalDialogueHeading: undefined,
                modalDialogueMessage: undefined,
                modalDialogueButtonLabel: undefined,

                orgIdPattern: store.orgIdPattern
            }
        },
        mounted () {
            formHelper.loaded()
        },
        methods: {
            showForm(mode) {
                if ( mode == 'id' ) {
                    this.showRegisterById = true
                    this.showRegisterByEmail = false
                } else {
                    this.showRegisterById = false
                    this.showRegisterByEmail = true
                }
            },
            handleError(error) {
                formHelper.responseErrorHandle(error)
            }
        }
    }
</script>
