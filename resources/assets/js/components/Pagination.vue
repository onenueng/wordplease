<template>
    <ul class="pagination">
        <li class="disabled">
            <a href="#" aria-label="Previous">
                <span class="fa fa-angle-double-left"></span>
            </a>
        </li>
        <li v-for="page in pages" :key="page.label" :class="page.class">
            <a style="cursor: pointer;" @click="pageClick(page.link)">{{ page.label }}</a>
        </li>
        <li>
            <a href="#" aria-label="Next">
                <span class="fa fa-angle-double-right"></span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            pagesCount: {
                type: [Number, String],
                required: true
            }
        },
        data() {
            return {
                currentPage: 1
            }
        },
        mounted() {
            // console.log('pageination mounted')

        },
        computed: {
            pages() {
                if ( this.currentPage == 1 ) {
                    return [
                        {class:'active', link: '/test/page/1', label: '1'},
                        {class:'', link: '/test/page/2', label: '2'},
                        {class:'', link: '/test/page/3', label: '3'},
                        {class:'', link: '/test/page/4', label: '4'},
                        {class:'', link: '/test/page/5', label: '5'},
                    ]
                }
            }
        },
        methods: {
            pageClick(page) {
                console.log(page)
            }
        }

    }
</script>
