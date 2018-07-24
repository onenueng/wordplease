<template>
    <div class="col-xs-12">
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button
                v-for="(choice, index) in tree.choices"
                :key="choice"
                type="button"
                :topic="topic"
                class="btn btn-default btn-sm"
                :group="tree.name"
                @click="click"
                style="font-weight: bold;" v-html="choice">
            </button>
        </div>
        <transition name="slide-fade">
            <div v-show="open" v-if="hasChildren">
                <helper-tree
                    class="indent"
                    v-for="(tree, index) in tree.children"
                    :key="index"
                    :tree="tree"
                    :topic="topic">
                </helper-tree>
            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        name: 'helper-tree',
        props: {
            tree: {
                type: Object,
                required: true
            },
            topic: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                open: false
            }
        },
        computed: {
            hasChildren: function () {
                return this.tree.children && this.tree.children.length
            }
        },
        methods: {
            click () {
                $('button.active[group=' + event.target.getAttribute('group') + ']').removeClass('active')
                event.target.className = "btn btn-default btn-sm active"
                EventBus.$emit('store-helper', this.topic, event.target.getAttribute('group'),event.target.innerHTML)
            }
        },
        mounted () {
            if ( this.hasChildren ) {
                EventBus.$on(this.tree.name, (value) => { this.open = value })
            }
        }
    }
</script>
<style>
    .indent {
        padding-left: 5px;
        padding-top: 3px;
    }
</style>
