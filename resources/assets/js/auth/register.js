require('../bootstrap')

// in case of need to use global event bus
window.EventBus = new Vue()

Vue.component('register-by-email', require('../components/auth/RegisterByEmail.vue'))
Vue.component('register-by-id', require('../components/auth/RegisterById.vue'))
Vue.component('register-page', require('../components/auth/RegisterPage.vue'))
Vue.component('input-state', require('../components/inputs/InputState.vue'))
Vue.component('button-app', require('../components/ButtonApp.vue'))
Vue.component('alert', require('../components/Alert.vue'))


window.app = new Vue({
    el: '#app',
    mounted() {
        $('#page-loader').remove()
    }
})
