require('../bootstrap')

// in case of need to use global event bus
window.EventBus = new Vue()

Vue.component('register-page', require('../components/auth/RegisterPage.vue'))
Vue.component('register-by-id', require('../components/auth/RegisterById.vue'))
Vue.component('input-state', require('../components/inputs/InputState.vue'))

window.app = new Vue({
    el: '#app',
    mounted() {
        $('#page-loader').remove()
    }
})
