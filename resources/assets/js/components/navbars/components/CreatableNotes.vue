<template>

<li class="dropdown hvr-bounce-to-bottom">
    <a class="dropdown-toggle bigger-font-25"
       aria-haspopup="true"
       aria-expanded="false"
       role="button"
       data-toggle="dropdown"
       disabled>
       <u>{{ 'HN ' + admission.hn + ' ' + admission.patient_name }}</u>
       <span> | Create <i class="fa fa-file-text"></i></span>
    </a>
    <ul class="dropdown-menu">
        <li v-for="note in notes" :key="note.label">
            <a
                data-toggle="tooltip"
                :title="note.title"
                :class="getClass(note.creatable)"
                :style="getCursorStyle(note.creatable)"
                @click="selecteNote(note)"
                v-html="note.label">
            </a>
        </li>
    </ul>
</li>

</template>

<script>
    export default {
        data () {
            return {
                admission: {},
                notes: {}
            }
        },
        created () {
            this.admission = store.admission
            axios.post('/get-creatable-notes/' + this.admission.an)
                .then( (response) => {
                    this.notes = response.data
                    this.showCreatableNotes = true
                }).catch( (error) => {
                    this.$emit('error', error)
                })
        },
        methods: {
            selecteNote(note) {
                this.$emit('noteSelected', note)
            },
            getClass(creatable) {
                return creatable ? 'hvr-underline-from-left' : 'unable-to-create-title disabled'
            },
            getCursorStyle(creatable) {
                return creatable ?
                       'cursor: pointer;' :
                       'text-decoration: line-through; cursor: not-allowed!important;'
            }
        },
        updated() {
            $('.unable-to-create-title').tooltip({
                container: "body",
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100 }
            })
        }
    }
</script>
