<template>
    <ul class="nav navbar-nav navbar-right">
        <li v-for="action in actions"><a :href="action.link">{{ action.label }}</a></li>
        <li class="active"><a role="button">{{ username }}</a></li>
        <li class="hvr-bounce-to-top"><a href="/logout"><span class="fa fa-sign-out"></span></a></li>
    </ul>
</template>

<script>
    export default {
        props: ['username'],
        data () {
            return {
                actions: []
            }
        },
        mounted () {
            axios.get('/get-actions')
                 .then( (response) => {
                    this.actions = response.data
                 }).catch(function (error) {
                    console.log(error);
                 });
        }
    }
</script>
