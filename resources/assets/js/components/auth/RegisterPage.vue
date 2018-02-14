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
                        :id-name="idName"
                        :pattern="pattern">
                    </register-by-id>
                </div>

                <div v-if="showRegisterByEmail">
                    <register-by-email></register-by-email>
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
                showRegisterById: false,
                showRegisterByEmail: false,
            }
        },
        methods: {
            showForm(mode) {
                if (mode == 'id') {
                    this.showRegisterById = true
                    this.showRegisterByEmail = false
                } else {
                    this.showRegisterById = false
                    this.showRegisterByEmail = true
                }
            },
        }
    }
</script>
