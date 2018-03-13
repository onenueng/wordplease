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
        },
        mounted() {
            EventBus.$on('pageClicked', (page) => {
                axios.get('/pagy?page=' + page)
                     .then( (response) => {
                        console.log(response.data)
                     })
                     .catch( (error) => {
                        console.log(error)
                     })
                console.log('page ' + page + ' clicked')
            })
        }
    }
</script>
