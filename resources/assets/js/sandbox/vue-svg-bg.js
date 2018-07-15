require('../bootstrap-min')

import setBackground from './svg-bg.js'
import formHelper from '../modules/form-helper.js'

window.app = new Vue({
    el: '#app',
    methods: {
        hello () { // delegate
            setBackground.testA()
        }
    },
    mounted() {
        formHelper.formLoaded()
        setBackground.bgxyy('hello-svg-bg-perfect')
        // setBackground.testA()
    }
})
