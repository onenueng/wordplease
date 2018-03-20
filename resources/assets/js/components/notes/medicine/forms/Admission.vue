<template>

<div class="container-fluid"><!-- note content -->
    <panel heading='Admission data'><!-- Panel Admission Data -->
        <div class="row"><!-- wrap content with row class -->
            <input-text
                value="12-Jun-2015 12:35"
                label="Admit :"
                grid="12-6-3"
                readonly>
            </input-text><!-- datetime_admit -->
        </div>
    </panel>
</div>
</template>

<script>
    import Panel from '../../../Panel.vue'
    import InputText from '../../../inputs/InputText.vue'

    export default {
        components: {
            'panel': Panel,
            'input-text' : InputText
        },

        // implement input-text sync data
        // window.location.href
        // window.location.hostname
        // window.location.pathname
    }
</script>
