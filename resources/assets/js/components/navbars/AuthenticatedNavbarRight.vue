<template>
    <ul class="nav navbar-nav navbar-right">
        <li class="active meta-tooltip"
            title="profile"
            data-toggle="tooltip">
            <a href="/profile">{{ user.name }}</a>
        </li>
        <li class="meta-tooltip"
            title="logout"
            data-toggle="tooltip">
            <a href="/logout"><span class="fa fa-sign-out"></span></a>
        </li>
    </ul>
</template>

<script>
    export default {
        data () {
            return {
                user: store.user
            }
        },
        mounted() {
            $('.meta-tooltip').tooltip({
                container: "body",
                placement: "bottom",
                trigger: "hover"
            })
        }
    }
</script>
