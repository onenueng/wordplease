<template>
    <label class="checkbox-inline">
        <input type="checkbox" :name="field"> {{ label }}
    </label>
</template>

<script>
    export default {
        props: ['field', 'label']
    }
</script>
