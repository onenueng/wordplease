<template>
    <!-- edit note Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-function-list" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/notes">{{ noteName }}</a>
                <a class="navbar-brand active" v-html="patientData"> <span class="sr-only">(current)</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-function-list">
                <ul class="nav navbar-nav">
                    <li><a href=""><i class="fa fa-globe"></i> Publish</a></li>
                    <li v-show="showSaving"><a> saving <i class="fa fa-circle-o-notch fa-spin fa-fw"></i></a></li>
                </ul>
                <appbar-right :username="username">
                    <li v-for="action in actions"><a :href="action.link" v-html="action.label"></a></li>
                </appbar-right>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['noteName', 'patientData', 'username', 'showSaving'],
        data () {
            return {
                actions: [
                    { link: '/apple', label: '<i class="fa fa-save"></i> & Stay' },
                    { link: '/oppo', label: '<i class="fa fa-save"></i> & New note' },
                    { link: '/samsung', label: '<i class="fa fa-save"></i> & logout' },
                ]
            }
        }
    }
</script>
