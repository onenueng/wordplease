<template>
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a role="button">{{ username }}</a></li>
        <li class="hvr-bounce-to-top"><a href="/logout"><span class="fa fa-sign-out"></span></a></li>
    </ul>
</template>

<script>
    export default {
        props: {
            username: {
                type: String,
                required: true
            }
        }
    }
</script>
