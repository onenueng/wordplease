<template>
    <div class="container-fluid">
        <pagination
            :pages-count="pagesCount">
        </pagination>
    </div>
</template>

<script>
    import Pagination from '../Pagination.vue'
    export default {
        components: {
            'pagination': Pagination
        },
        props: {
            pagesCount: {
                type: String,
                required: true
            }
        }
    }
</script>