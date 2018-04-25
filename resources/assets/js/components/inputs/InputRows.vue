<template>
    <div>
        <div class="col-xs-12" v-if="label !== undefined">
            <label :class="'label-control topped '  + ((list.length > rowLimit) ? 'animated pulse infinite' : '')">{{ label }}
                <span class="text-danger" v-if="list.length == rowLimit">Row Limit Exceeded</span>
                <span class="text-danger" v-if="list.length > rowLimit">Please manage rows or lose those exceeded the limit</span>
            </label>
        </div>
        <!-- @start="onStart" @change="onChange" @add="onAdd" @remove="onRemove" @end="onEnd" -->
        <draggable
            :list="list"
            @sort="autosave"
            :options="draggableOptions">
            <div class="form-group-sm"
                 v-for="(item, index) in list" :key="field + '-item-' + index">
                <div class="col-xs-12 col-sm-8 col-md-10"
                     style="padding-right: 2px;">
                    <textarea :class="'form-control' + ((index+1) <= rowLimit ? '': ' overFlow') + (isDuplicate(index, item.value) ? ' duplicate' : '')"
                              :id="field + '-' + (index+1)"
                              v-model="item.value"
                              rows="1"
                              @input="onKeyPressed"
                              @keydown.enter.prevent="onEnterKeyPressed"
                              @keydown.down.prevent="onDownKeyPressed"
                              @keydown.up.prevent="onUpKeyPressed"
                              @focus="currentRow = index"></textarea>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2"
                     style="padding-top: 4px; background: #ffffd3!important;"
                     v-if="rowLimit > 1 || list.length > 1">
                    <span v-if="list.length > 1" class="badge drag-icon">
                        <span>{{ index + 1 }}</span>
                    </span>
                    <button-app
                        :action="'add-' + field"
                        status="info"
                        label="<span class='fa fa-plus'></span>"
                        size="xs"
                        no-tap-stop
                        v-if="list.length < rowLimit">
                    </button-app>
                    <button-app
                        :action="{ event: 'delete-' + field, value: index }"
                        status="danger"
                        label="<span class='fa fa-trash-o'></span>"
                        size="xs"
                        no-tap-stop
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
                list: this.items.length == 0 ? [{ value: null }] : this.items,
                draggableOptions: {
                    handle:'.drag-icon',
                    group: this.groupName
                }
            }
        },
        methods: {
            isDuplicate (index, value) {

                let rowCount = this.list.length
                // let firstFound = -1
                for (let i = 0; i < rowCount; i++) {
                    if ( i != index && this.list[i].value == value ) {
                        // console.log(i + ' => ' + index + ' : ' + this.list[i].value + ' => ' + value + ' : ' + firstFound )
                        // if ( firstFound == -1 ) {
                        //     firstFound = i
                        // } else if ( index > firstFound ) {
                        //     return true
                        // }
                        console.log(i + ' => ' + index + ' : ' + this.list[i].value + ' => ' + value)
                        return true
                    }
                }
                return false
            },
            onEnterKeyPressed () {
                if ( this.list.length < (this.rowLimit) ) {
                    this.list.push({ value: null })
                    setTimeout(() => { document.getElementById(this.field + '-' + this.list.length).focus() }, 100)
                }
            },
            onDownKeyPressed () {
                if ( (this.currentRow+1) < this.list.length ) {
                    document.getElementById(this.field + '-' + (this.currentRow + 2)).focus()
                }
            },
            onUpKeyPressed () {
                if ( this.currentRow != 0 ) {
                    document.getElementById(this.field + '-' + (this.currentRow)).focus()
                }
            },
            onKeyPressed () {
                // defined on mounted
            },
            autosave () {
                let newList
                if ( this.list.length > this.rowLimit ) {
                    newList = this.list.slice(0, this.rowLimit)
                    // EventBus.$emit('autosave', this.field, this.list.slice(0, this.rowLimit))
                } else {
                    newList = this.list.slice()
                    // EventBus.$emit('autosave', this.field, this.list)
                }
                EventBus.$emit('autosave', this.field, newList)
            }
        },
        mounted () {
            this.onKeyPressed = _.debounce(() => { this.autosave() }, 5000)

            EventBus.$on('add-' + this.field, () => { this.onEnterKeyPressed() })

            EventBus.$on('delete-' + this.field, (index) => {
                this.list.splice(index, 1)
                this.autosave()
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

    .duplicate {
        background:#f0ad4e;
    }
</style>
