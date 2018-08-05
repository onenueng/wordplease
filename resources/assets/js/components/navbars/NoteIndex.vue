<template>
    <navbar :brand="brand"><!-- Main Navbar -->
        <ul
            class="nav navbar-nav"
            slot="navbar-left">
            <an-form />
            <creatable-notes v-if="showCreatableNotes" :an="an" />
        </ul><!-- Navbar Left Actions -->
        
        <navbar-right slot="navbar-right" /><!-- Navbar Right Actions -->
    </navbar>
</template>

<script>
    import CreatableNotes from './components/CreatableNotes.vue'
    import NavbarRight from './AuthenticatedNavbarRight.vue'
    import AnForm from './components/AnForm.vue'
    import Navbar from './Navbar.vue'

    export default {
        components: {
            CreatableNotes,
            NavbarRight,
            AnForm,
            Navbar
        },
        props: {
            brand: { reqiured: true }
        },
        data () {
            return {
                showCreatableNotes: false,
                an: ''
            }
        },
        mounted() {
            // EventBus.$on('an-checked', (valid, value) => {
            //     this.showCreatableNotes = valid
            //     if ( valid ) {
            //         this.an = value
            //     }
            // })
        }
    }
</script>
