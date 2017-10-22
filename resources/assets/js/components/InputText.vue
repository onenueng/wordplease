<template>
    <div class="form-group form-group-sm">
        <label class="control-label" for="name">{{ label }}</label>
        <input type="text" class="form-control" :name="name" v-model="userInput" @input="fx()" />
    </div>
</template>

<script>
    export default {
        props: ['name', 'value', 'label'],
        data () {
            return {
                userInput: ''
            }
        },
        mounted () {
            this.userInput = this.value;
        },
        methods: {
            fx () {
                console.log(this.userInput);
            }
        }
    }
</script>
