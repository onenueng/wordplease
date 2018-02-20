<template>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand hvr-shutter-out-vertical" :href="link">{{ brand }}</a>
                <a class="navbar-brand active">{{ title }}</a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props: {
            link: {
                type: String,
                required: true
            },
            brand: {
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            }
        }
    }
</script>
