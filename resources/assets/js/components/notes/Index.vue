<template>
    <div>
        <modal-dialogue
            :toggle="modalDialogueToggle"
            :heading="modalDialogueHeading"
            :message="modalDialogueMessage"
            :buttonLabel="modalDialogueButtonLabel"
            @modalDialogueDismiss="modalDialogueToggle = false" />
        <modal-action
            action-button-label="Create"
            heading="Please confirm"
            :toggle="modalActionToggle"
            :body="modalActionBody"
            :busy="modalActionBusy"
            @confirmed="createNote"
            @dismiss="modalActionToggle = flase" /><!-- display create note confirmation -->
        <page-navbar
            :brand="{ link: '/', title: 'IPD Note', subTitle: user.division }"
            @showConfirmation="showConfirmation"
            @error="handleError" />
        <h1>Note Index</h1>
    </div>
</template>

<script>
// components
import ModalDialogue from '../modals/ModalDialogue.vue'

import ModalAction from '../modals/SingleAction.vue'
import PageNavbar from '../navbars/NoteIndex.vue'

// utilities
import formHelper from "../../modules/form-helper.js"
export default {
    components: {
        PageNavbar,
        ModalAction,
        ModalDialogue
    },
    data () {
        return {
            modalDialogueToggle: undefined,
            modalDialogueHeading: undefined,
            modalDialogueMessage: undefined,
            modalDialogueButtonLabel: undefined,

            modalActionToggle: false,
            modalActionBusy: false,
            modalActionBody: '<h1>Hello Content</h1>',

            user: store.user
        }
    },
    mounted () {
        formHelper.loaded()
    },
    methods: {
        handleError(error) {
            formHelper.responseErrorHandle(error)
        },
        showConfirmation(body) {
            this.modalActionToggle = true
            this.modalActionBody = body
        },
        createNote() {
            this.modalActionBusy = true
            axios.post('/try-create-note', {
                an: store.admission.an,
                noteTypeId: store.noteSelected.noteTypeId,
                class: store.noteSelected.class,
                retitle: store.noteSelected.retitle
            })
            .then((response) => {
                this.modalActionBusy = false
                if ( response.data.reply_code == 0 ) {
                    window.location.href = response.data.reply_text
                } else {
                    this.modalDialogueMessage = response.data.reply_text
                    this.modalDialogueToggle = true
                }
            })
            .catch((error) => {
                formHelper.responseErrorHandle(error)
            })
        }
    }
}

</script>
