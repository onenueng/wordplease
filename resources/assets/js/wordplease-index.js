require('./bootstrap');


Vue.component('create-note-bar', require('./components/CreateNoteBar.vue'));
Vue.component('creatable-notes', require('./components/CreatableNotes.vue'));
Vue.component('appbar-right', require('./components/AppbarRight.vue'));
Vue.component('appbar', require('./components/Appbar.vue'));
Vue.component('input-text', require('./components/InputText.vue'));

new Vue({
    el: '#app'
});
