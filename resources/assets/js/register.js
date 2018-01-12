require('./bootstrap')

Vue.component('register-page', require('./components/RegisterPage.vue'))

window.app = new Vue({
    el: '#app',
    mounted() {
        console.log('hello register')
    }
})
