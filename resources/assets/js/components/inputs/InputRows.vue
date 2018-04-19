<template>
    <div>
        <div class="col-xs-12"><label class="label-control topped">Principle diagnosis :</label></div>
        <draggable :list="list" @start="drag=true" @end="drag=false" :options="{ handle:'.drag-icon', group: groupName }">
            <div class="form-group-sm" v-for="(item, index) in list" :key="field + '-item-' + index">
                <div class="col-xs-12 col-sm-8 col-md-10" style="padding-right: 2px;">
                    <textarea class="form-control"
                            :id="field + '-' + (index+1)"
                            v-model="item.value"
                            rows="1"
                            @input="onkeypressed"
                            @keydown.enter.prevent="onEnterKeyPressed"
                            @keydown.page-down.prevent="onPageDownKeyPressed"
                            @keydown.page-up.prevent="onPageUpKeyPressed"
                            @focus="currentRow = index"></textarea>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2" style="padding-top: 4px; background: #ffffd3!important;">
                    <span v-if="list.length > 1" class="badge drag-icon">
                        <i class="fa fa-align-justify"></i>
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
        <div class="col-xs-12" v-if="list.length == rowLimit"><p class="text-danger">You have reached limit rows</p></div>
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
                list: this.items
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
            onkeypressed () {
                // defined on mounted
            },
            autosave () {
                console.log(this.list)
            }
        },
        mounted () {
            this.onkeypressed = _.debounce(() => { this.autosave() }, 5000)

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
</style>
