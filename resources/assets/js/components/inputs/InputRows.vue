<template>
    <div>
        <div class="col-xs-12" v-if="label !== undefined">
            <label class="label-control topped">{{ label }} <span class="text-danger" v-if="list.length == rowLimit">You have reached limit rows</span></label>

        </div>
        <!-- @end="drag=false" -->
        <draggable
            :list="list"
            @start="onStart"
            @change="onChange"
            @add="onAdd"
            @remove="onRemove"
            @sort="onSort"
            @end="onEnd"
            :options="draggableOptions">
            <div class="form-group-sm" v-for="(item, index) in list" :key="field + '-item-' + index">
                <div class="col-xs-12 col-sm-8 col-md-10" style="padding-right: 2px;">
                    <textarea :class="controlClass(index+1)"
                            :id="field + '-' + (index+1)"
                            v-model="item.value"
                            rows="1"
                            @input="onKeyPressed"
                            @keydown.enter.prevent="onEnterKeyPressed"
                            @keydown.page-down.prevent="onPageDownKeyPressed"
                            @keydown.page-up.prevent="onPageUpKeyPressed"
                            @focus="currentRow = index"></textarea>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2" style="padding-top: 4px; background: #ffffd3!important;" v-if="rowLimit > 1 || list.length > 1">
                    <span v-if="list.length > 1" class="badge drag-icon">
                        <span>{{ index + 1 }}</span>
                    </span>
                    <button-app
                        :action="'add-' + field"
                        status="info"
                        label="<span class='fa fa-plus'></span>"
                        size="xs"
                        v-if="list.length < rowLimit">
                    </button-app>
                    <button-app
                        :action="{ event: 'delete-' + field, value: index }"
                        status="danger"
                        label="<span class='fa fa-trash-o'></span>"
                        size="xs"
                        v-if="list.length > 1">
                    </button-app>
                </div>
            </div>
        </draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: {
            field: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: false
            },
            groupName: {
                type: String,
                required: false,
                default: this.field
            },
            rowLimit: {
                type: Number,
                required: false,
                default: 1
            },
            items: {
                type: Array,
                required: false,
                default: () => { return [{ value: null }] }
            }
        },
        data () {
            return {
                currentRow: 0,
                list: this.items,
                draggableOptions: {
                    handle:'.drag-icon',
                    group: this.groupName,
                    onRemove: function (evt) { EventBus.$emit('hello-vue-drag') }
                }
            }
        },
        methods: {
            onEnterKeyPressed () {
                if ( this.list.length < (this.rowLimit) ) {
                    this.list.push({ value: null })
                    setTimeout(() => { document.getElementById(this.field + '-' + this.list.length).focus() }, 100)
                }
            },
            onPageDownKeyPressed () {
                if ( (this.currentRow+1) < this.list.length ) {
                    document.getElementById(this.field + '-' + (this.currentRow + 2)).focus()
                }
            },
            onPageUpKeyPressed () {
                if ( this.currentRow != 0 ) {
                    document.getElementById(this.field + '-' + (this.currentRow)).focus()
                }
            },
            onKeyPressed () {
                // defined on mounted
            },
            onStart () {
                console.log(this.field + ': i am Start')
            },
            onEnd () {
                console.log(this.field + ': i am end')
            },
            onChange () {
                console.log(this.field + ': i am Change')
            },
            onAdd () {
                console.log(this.field + ': i am Add')
            },
            onRemove () {
                console.log(this.field + ': i am Remove')
            },
            onSort () {
                console.log(this.field + ': i am Sort')
            },
            autosave () {
                console.log(this.list)
            },
            controlClass (index) {
                return (index) <= this.rowLimit ? 'form-control':'form-control overFlow'
            }
        },
        mounted () {
            this.onKeyPressed = _.debounce(() => { this.autosave() }, 5000)

            EventBus.$on('add-' + this.field, () => { this.onEnterKeyPressed() })

            EventBus.$on('delete-' + this.field, (index) => {
                this.list.splice(index, 1)
            })
        },
        updated () {
            this.list.forEach((item, index) => {
                autosize(document.getElementById(this.field + '-' + (index+1)))
                autosize.update(document.getElementById(this.field + '-' + (index+1)))
            })
        }
    }
</script>

<style>
    .drag-icon {
        cursor: move;
        cursor: -webkit-grabbing;
    }

    .overFlow {
        background:#d9534f;
    }
</style>
