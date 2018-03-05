require('./bootstrap');


Vue.component('create-note-form', require('./components/CreateNoteForm.vue'));
Vue.component('creatable-notes', require('./components/CreatableNotes.vue'));
Vue.component('appbar-right', require('./components/AppbarRight.vue'));
Vue.component('navbar', require('./components/CreateNoteNavbar.vue'));
Vue.component('input-text', require('./components/InputText.vue'));

new Vue({
    el: '#app'
});
