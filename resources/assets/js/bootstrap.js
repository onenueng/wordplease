// global dependecies
window._ = require('lodash');
window.$ = window.jQuery = require('jquery')
require('bootstrap-sass')
window.axios = require('axios')
window.Vue = require('vue')

// config csrf token
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
let token = document.head.querySelector('meta[name="csrf-token"]')
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found.')
}

window.SESSION_LIFETIME = 1000 * 60 * 60 // an hour

window.loadPageAt = Date.now()