<template>
    <div class="material-box">
        <label><i>Quote :</i></label>
        <blockquote @mousemove="onselect"
                    @mousedown="dragging = true"
                    @mouseup="mouseup"
                    v-html="quote">
        </blockquote>
        <transition-group name="slide-fade" tag="div">
            <div class="row" v-for="(change, index) in changes" :key="index">
                <div class="col-xs-12">
                    <div class="form-group-sm">
                        <textarea class="form-control"
                                  v-model="change.old"
                                  readonly
                                  rows="1">
                        </textarea>
                    </div>
                </div>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-10" style="padding-right: 5px;">
                    <div class="form-group-sm">
                        <textarea class="form-control"
                                  v-model="change.new"
                                  @click="currentChange = index"
                                  rows="1">
                        </textarea>
                    </div>
                </div>
                <div class="col-xs-2" style="padding: 5px;">
                    <button-app
                        :action="{ event: 'delete-' + field + '-change', value: index }"
                        status="danger"
                        label="<span class='fa fa-trash-o'></span>"
                        size="sm">
                    </button-app>
                    <button-app
                        v-if="index == currentChange"
                        action=""
                        status="info"
                        label="<span class='fa fa-cog fa-spin fa-fw'></span>"
                        size="sm">
                    </button-app>
                </div>
            </div>
        </transition-group>
        <button-app
            :action="'new-' + field + '-change'"
            status="primary"
            label="<span class='fa fa-pencil-square-o'></span><span class='fa fa-plus-circle'></span>"
            size="lg">
        </button-app>
    </div>
</template>
<script>
    import ButtonApp from '../buttons/ButtonApp.vue'

    export default {
        components: {
            'button-app' : ButtonApp
        },
        props: {
            field: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: true
            },
            value: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                quote: null,
                tmpQuote: null,
                currentChange: 0,
                dragging: false,
                changes: [
                    { old: null, new: null }
                ]
            }
        },
        methods: {
            onselect () {
                if ( this.dragging ) {
                    let item = {
                        old: window.getSelection().toString(),
                        new : this.changes[this.currentChange].new
                    }
                    this.changes.splice(this.currentChange, 1, item)
                    autosize($('textarea'))
                }
            },
            mouseup () {
                this.dragging = false
                this.updateQuote()
            },
            updateQuote () {
                let newQuote = this.tmpQuote
                this.changes.forEach((item, index) => {
                    newQuote = newQuote.replace( item.old, '<del>' + item.old + '</del>')
                })
                this.quote = newQuote
            }
        },
        mounted () {
            this.quote = this.value
            this.tmpQuote = this.quote

            EventBus.$on('delete-' + this.field + '-change', (index) => {
                if ( this.changes.length == 1 ) {
                    this.changes.pop()
                    this.changes.push( { old: null, new: null } )
                } else {
                    this.changes.splice(index, 1)
                }
                this.updateQuote()
                this.currentChange = 0
            })

            EventBus.$on('new-' + this.field + '-change', () => {
                this.changes.push( { old: null, new: null } )
                this.currentChange = this.changes.length - 1
            })

            EventBus.$on('set-' + this.field + '-change', (text) => {
                if ( this.changes[this.currentChange].new == null || this.changes[this.currentChange].new == '' ) {
                    this.changes[this.currentChange].new = text
                } else {
                    this.changes[this.currentChange].new += ('\n' + text)
                }
            })

            autosize($('textarea'))
        },
        updated () {
            autosize.update($('textarea'))
        }
    }
</script>
