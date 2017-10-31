require('./bootstrap');

// in case of need to use global event bus
// window.EventBus = new Vue();


Vue.component('alert-box', require('./components/Alertbox.vue'));
Vue.component('navbar', require('./components/EditNoteNavbar.vue'));
Vue.component('appbar-right', require('./components/AppbarRight.vue'));
Vue.component('panel', require('./components/Panel.vue'));
Vue.component('input-text', require('./components/InputText.vue'));
Vue.component('input-suggestion', require('./components/InputSuggestion.vue'));
Vue.component('input-select', require('./components/InputSelect.vue'));
Vue.component('input-textarea', require('./components/InputTextarea.vue'));
Vue.component('input-radio', require('./components/InputRadio.vue'));
Vue.component('input-check', require('./components/InputCheck.vue'));
Vue.component('input-check-group', require('./components/InputCheckGroup.vue'));

Vue.component('input-select-new', require('./components/InputSelectNew.vue'));

window.app = new Vue({
    el: '#app',
    data: {
        showAlertbox: false,
        alertboxMessage: "Hello World",
        alertStatus: "warning",
        alertDuration: 5000,
        autosaving: false
    }
});

window.toggleAlertbox = (message, status, duration = 5000) => {
    if (! app.$data.showAlertbox) {
        app.$data.alertboxMessage = message;
        app.$data.alertStatus = status;
        app.$data.alertDuration = duration;
        app.$data.showAlertbox = true;
    }
}

// window.EventBus = new Vue;
