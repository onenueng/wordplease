<template>
    <navbar :brand="brand"><!-- Main Navbar -->
        <ul
            class="nav navbar-nav"
            slot="navbar-left">
            <an-form
                placeholder="AN to create note"
                :pattern="anPattern"
                :disabled="disabled"
                :tooltip="tooltip"
                v-model="an"
                @validated="validAn" />
            <creatable-notes v-if="showCreatableNotes" :an="an" />
        </ul><!-- Navbar Left Actions -->

        <navbar-right slot="navbar-right" /><!-- Navbar Right Actions -->
    </navbar>
</template>

<script>
    import CreatableNotes from './components/CreatableNotes.vue'
    import NavbarRight from './AuthenticatedNavbarRight.vue'
    import AnForm from './components/TextInputForm.vue'
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
                an: '', // v-model

                disabled: false,
                tooltip: '',
                showCreatableNotes: false,

                value: '',

                anPattern: store.anPattern
            }
        },
        methods: {
            validAn (valid) {
                if (valid) {
                    this.disabled = true
                    axios.post('/get-admission/' + this.an)
                         .then((response) => {
                            console.log(response)
                            if ( response.data.reply_code != 0 ) {
                                this.tooltip = response.data.reply_text

                            } else {
                                this.showCreatableNotes = true
                                store.admission = response.data
                            }
                            this.disabled = false
                         })
                         .catch((error) => {
                            this.$emit('error', error)
                         })
                } else {
                    this.showCreatableNotes = false
                }
            }
        }
    }
</script>
