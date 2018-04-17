<template>
    <div>
        <div
            v-for="(group, index) in groups"
            :key="group.name"
            class="col-xs-12"
            style="padding-bottom: 3px;">
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button
                    v-for="choice in group.choices"
                    :key="choice"
                    type="button"
                    class="btn btn-default btn-sm"
                    :group="group.name"
                    style="font-weight: bold;"
                    @click="click">{{ choice }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            topic: {
                type: String,
                required: true
            },
            groups: {
                type: Array,
                required: true
            }
        },
        methods: {
            click() {
                $('button.active[group=' + event.target.getAttribute('group') + ']').removeClass('active')
                event.target.className = "btn btn-default btn-sm active"
                EventBus.$emit('store-helper', this.topic, event.target.getAttribute('group'),event.target.innerHTML)
            }
        }
    }
</script>
