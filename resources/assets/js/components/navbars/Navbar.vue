<template>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" :href="link">{{ brand }}</a>
                <a class="navbar-brand active" v-html="title"></a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar">
                <slot name="navbar-left"></slot>
                <slot name="navbar-right"></slot>
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
