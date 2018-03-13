<template>
    <ul class="pagination">
        <li v-for="page in pages" :key="page.key" :class="page.class">
            <a role="button" @click="pageClick(page.key, page.label)">{{ page.label }}</a>
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
                maxPageButtons: 10,
                currentPage: 1
            }
        },
        mounted() {
            // console.log('pageination mounted')
        },
        computed: {
            pages() {
                let maxPageButtons = 9
                let offset = 2
                let pages = []
                pages.push({key: 1, label: 1, class: this.currentPage == 1 ? 'active' : ''})

                if ( this.pagesCount <= maxPageButtons ) {
                    for ( var i = 2 ; i <= this.pagesCount - 1 ; i++ ) {
                        pages.push({key: i, label: i, class: this.currentPage == i ? 'active' : ''})
                    }

                } else if ( (this.currentPage - offset) <= (offset + 1) ) {
                    for ( var i = 2 ; i <= (maxPageButtons - offset); i++ ) {
                        pages.push({key: i, label: i, class: this.currentPage == i ? 'active' : ''})
                    }
                    pages.push({key: this.pagesCount - 1, label: '...', class: 'disabled'})

                } else if ( (this.currentPage + offset) > (this.pagesCount - offset - 1) ) {
                    pages.push({key: i++, label: '...', class: 'disabled'})
                    var i = this.pagesCount - ( maxPageButtons - offset - 1)
                    for (  ; i <= this.pagesCount - 1; i++ ) {
                        pages.push({key: i, label: i, class: this.currentPage == i ? 'active' : ''})
                    }

                } else {
                    pages.push({key: 2, label: '...', class: 'disabled'})
                    for ( var i = this.currentPage - offset ; i <= this.currentPage + offset; i++ ) {
                        pages.push({key: i, label: i, class: this.currentPage == i ? 'active' : ''})
                    }
                    pages.push({key: this.pagesCount - 1, label: '...', class: 'disabled'})

                }
                pages.push({key: this.pagesCount, label: 'Last', class: this.currentPage == this.pagesCount ? 'active' : ''})
                return pages
            },
        },
        methods: {
            pageClick(page, label) {
                if ( label !== '...' ) {
                    this.currentPage = page
                    EventBus.$emit('pageClicked', page)
                }
            }
        }

    }
</script>
