<template>
    <div class="material-box clearfix">
        <div class="col-md-12 btn-group-in-well" v-for="group in groups" :key="group.name">
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button
                    v-for="choice in group.choices"
                    :key="choice.name"
                    type="button"
                    :class="choice.class"
                    :group="group.name"
                    @click="click">{{ choice.name }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            groups: {
                type: Array,
                required: true
            }
        },
        data () {
            return {
                xgroups: [
                    { name: 'a', values: ['apple', 'samsung', 'oppo'] },
                    { name: 'b', values: ['oracle', 'mysql', 'sql server'] },
                ]
            }
        },
        computed: {
            topic () {
                return {
                    group: 'condition_upon_DC_awareness',
                    value: 'รู้ตัวดี ถามตอบได้ปรกติ',
                    class: 'btn btn-default btn-sm' + (this.store['condition_upon_DC_awareness'] == 'รู้ตัวดี ถามตอบได้ปรกติ' ? 'active' : '')
                }
            }
        },
        methods: {
            btnClass(group, value) {
                let newClass = 'btn btn-default btn-sm btn-template'
                newClass += this.store[group] == value ? 'active' : ''
                return newClass
            },
            // click(group, value) {
            //     // console.log('hello click')
            //     this.store[group] = value
            // }
            click() {
                event.target.classList.add('active')
                // console.log(event.target.classList.add('active'))
            }
        },
        updated () {
            console.log(this.store)
        }
    }

    $( () => {
        /**
        * .btn-template When click on button-group then handle an active button.
        **/
        $('.btn-template').click(function() {
            $('.btn-template.active[group=' + $(this).attr('group') + ']').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
