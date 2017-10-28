require('./bootstrap');

Vue.component('alert-box', require('./components/Alertbox.vue'));
Vue.component('navbar', require('./components/EditNoteNavbar.vue'));
Vue.component('appbar-right', require('./components/AppbarRight.vue'));
Vue.component('panel', require('./components/Panel.vue'));
Vue.component('input-text', require('./components/InputText.vue'));
Vue.component('input-suggestion', require('./components/InputSuggestion.vue'));
Vue.component('input-select', require('./components/InputSelect.vue'));

window.app = new Vue({
    el: '#app',
    data: {
        showAlertbox: false,
        alertboxMessage: "Hello World",
        alertStatus: 'warning',
        alertDuration: 5000,
        autosaving: false
    }
});
