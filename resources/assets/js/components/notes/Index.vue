<template>
    <div>
        <modal-dialogue :toggle="modalDialogueToggle"
                        :heading="modalDialogueHeading"
                        :message="modalDialogueMessage"
                        :buttonLabel="modalDialogueButtonLabel"
                        @modalDialogueDismiss="modalDialogueToggle = 'hide'" />

        <modal-action
            action-button-label="Create"
            heading="Please confirm"
            :toggle="modalActionToggle"
            :body="modalActionBody"
            :busy="modalActionBusy"
            @dismiss="modalActionToggle = flase" /><!-- show create note confirmation -->

        <page-navbar
            link="/"
            brand="IPD Note"
            title="DIVISION"
            username="USERNAME"
            an-pattern="^[0-9]{8}$" />

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
            modalActionBody: '<h1>Hello Content</h1>'
        }
    },
    mounted () {
        formHelper.loaded()
    }
}

</script>
