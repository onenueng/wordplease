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
            <an-form
                :pattern=anPattern>
            </an-form>
            <creatable-notes
                v-if="showCreatableNotes"
                :an="an">
            </creatable-notes>
        </ul>
        <!-- Navbar Right Actions -->
        <navbar-right
            slot="navbar-right"
            :username=username>
        </navbar-right>
    </navbar>
</template>

<script>
    import CreatableNotes from './components/CreatableNotes.vue'
    import NavbarRight from './AuthenticatedNavbarRight.vue'
    import AnForm from './components/AnForm.vue'
    import Navbar from './Navbar.vue'
    
    export default {
        components: {
            'creatable-notes': CreatableNotes,
            'navbar-right': NavbarRight,
            'an-form': AnForm,
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
            anPattern: {
                type: String,
                reqiured: true
            },
            username: {
                type: String,
                reqiured: true
            }
        },
        data () {
            return {
                showCreatableNotes: false,
                an: ''
            }
        },
        mounted() {
            EventBus.$on('an-checked', (valid, value) => {
                this.showCreatableNotes = valid
                if ( valid ) {
                    this.an = value
                }
            })
        }
    }
</script>
