<template>
    <!-- Create note Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hvr-shutter-out-vertical" :href="homeLink">{{ departmentName }}</a>
                <a class="navbar-brand active" >{{ appName }} <span class="sr-only">(current)</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <create-note-form
                        :pattern="pattern"
                        @validAn="isValidAn = true"
                        @invalidAn="isValidAn = false">
                    </create-note-form>
                    <creatable-notes
                        v-if="isValidAn">
                    </creatable-notes>
                </ul>
                <appbar-right :username="username"></appbar-right>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['homeLink', 'departmentName', 'appName', 'username', 'pattern'],
        data () {
            return {
                isValidAn: false
            }
        }
    }
</script>

