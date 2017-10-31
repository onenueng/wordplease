<template>
    <label class="checkbox-inline">
        <input type="checkbox"
               :name="field"
               :checked="thisChecked"
               @click="check()"/>
        {{ label }}
    </label>
</template>

<script>
    export default {
        props: ['field', 'label', 'checked', 'needSync'],
        data () {
            return {
                thisChecked: ''
            }
        },
        mounted() {
            this.thisChecked = (this.checked === undefined) ? '' : this.checked;
            
            // in case of need to use global event bus
            // if (this.onCloseExtra !== undefined) {
            //     EventBus.$on(this.onCloseExtra, () => {
            //         axios.post('/autosave', JSON.parse('{"' + this.field + '": ' + JSON.stringify(false) + '}'))
            //              .then((response) => { console.log(response.data); this.dirty = false; app.$data.autosaving = false; })
            //              .catch((error) => { console.log(error); app.$data.autosaving = false; });
            //         console.log(this.field);
            //     });
            // }

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync');
            }
        },
        beforeDestroy() {
            
        },
        methods: {
            check() {
                this.thisChecked = (this.thisChecked == '') ? 'checked' : '' ;
                app.$data.autosaving = true;
                axios.post('/autosave', JSON.parse('{"' + this.field + '": ' + JSON.stringify((this.thisChecked.length > 0)) + '}'))
                     .then((response) => { console.log(response.data); this.dirty = false; app.$data.autosaving = false; })
                     .catch((error) => { console.log(error); app.$data.autosaving = false; });
                console.log(this.thisChecked.length);
            }
        }
    }
</script>
