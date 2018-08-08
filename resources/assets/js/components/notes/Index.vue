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
            @dismiss="modalActionToggle = flase" /><!-- display create note confirmation -->
        <page-navbar
            :brand="{ link: '/', title: 'IPD Note', subTitle: user.division }"
            @error="handleError"  />
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
        }
    }
}

</script>
