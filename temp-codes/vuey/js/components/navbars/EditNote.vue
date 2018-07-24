<template>
    <!-- Main Navbar -->
    <navbar
        :link=link
        :brand=brand
        :title=title>
        <!-- Navbar Left Actions -->
        <ul
            class="nav navbar-nav"
            slot="navbar-left">
            <li><a href=""><i class="fa fa-globe"></i> Publish</a></li>
            <li v-show="autosaveIcon == 'show'"><a> saving <i class="fa fa-circle-o-notch fa-spin fa-fw"></i></a></li>
        </ul>
        <!-- Navbar Right Actions -->
        <navbar-right
            slot="navbar-right"
            :username=username>
        </navbar-right>
    </navbar>
</template>

<script>
    import NavbarRight from './AuthenticatedNavbarRight.vue'
    import Navbar from './Navbar.vue'

    export default {
        components: {
            'navbar-right': NavbarRight,
            'navbar': Navbar
        },
        props: {
            link: {
                type: String,
                reqiured: true
            },
            brand: {
                type: String,
                reqiured: true
            },
            title: {
                type: String,
                reqiured: true
            },
            username: {
                type: String,
                reqiured: true
            },
            autosaveIcon: {
                type: String,
                reqiured: true
            }
        }
    }
</script>
