<template>
    <ul class="pagination">
        <li v-if="currentPage !== 1 && pagesCount > maxPageButtons">
            <a @click="pageClick(1)" aria-label="Previous">
                <span class="fa fa-angle-double-left"></span>
            </a>
        </li>
        <li v-for="page in pages" :key="page.key" :class="page.class">
            <a style="cursor: pointer;" @click="pageClick(page.label)">{{ page.label }}</a>
        </li>
        <li v-if="currentPage !== pagesCount && pagesCount > maxPageButtons">
            <a @click="pageClick(pagesCount)" aria-label="Next">
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
                maxPageButtons: 10,
                currentPage: 1
            }
        },
        mounted() {
            // console.log('pageination mounted')

        },
        computed: {
            pages() {
                let delta = 2
                let range = []
                let rangeWithDots = []
                let l

                range.push({ key: 1, label: 1, class: this.currentPage == 1 ? 'active' : '' }); 

                if (this.pagesCount <= 1){
                    return range;
                }

                for ( let i = this.currentPage - delta; i <= this.currentPage + delta; i++ ) {
                    if ( i < this.pagesCount && i > 1 ) {
                        range.push({ key: i, label: i, class: this.currentPage == i ? 'active' : '' })
                    }
                }

                range.push({ key: this.pagesCount, label: this.pagesCount, class: this.currentPage == this.pagesCount ? 'active' : '' })

                return range

                for (let i of range) {
                    if (l) {
                        if (i - l === 2) {
                            rangeWithDots.push({ key: (l+1), label: (l+1), class: this.currentPage == (l+1) ? 'active' : '' });
                        } else if (i - l !== 1) {
                            rangeWithDots.push({ key: i, label: '...', class: this.currentPage == i ? 'active' : '' });
                        }
                    }
                    rangeWithDots.push(i);
                    l = i;
                }

                return rangeWithDots;
                // let pages = []
                // if ( this.pagesCount <= this.maxPageButtons ) {
                //     for (var i = 1; i <= this.pagesCount; i++) {
                //         pages.push({
                //             key: i,
                //             label: i,
                //             class: this.currentPage == i ? 'active' : ''
                //         })
                //     }
                //     return pages
                // }

                // for (var i = 1; i <= this.maxPageButtons; i++) {
                //     if ( i == 3 ) {
                //         pages.push({
                //             key: i,
                //             label: '...',
                //             class: 'disabled'
                //         })    
                //     } else if ( i == this.maxPageButtons - 2 ) {
                //         pages.push({
                //             key: i,
                //             label: '...',
                //             class: 'disabled'
                //         })
                //     } else {
                //         pages.push({
                //             key: i,
                //             label: i,
                //             class: this.currentPage == i ? 'active' : ''
                //         })
                //     }
                // }
                // return pages
            },

            classPreviousButton() {
                return this.currentPage == 1 ? 'disabled' : ''
            },

            classNextButton() {
                return this.currentPage == this.pagesCount ? 'disabled' : ''
            }
        },
        methods: {
            pageClick(page) {
                console.log(page)
                this.currentPage = page
            }
        }

    }
</script>
