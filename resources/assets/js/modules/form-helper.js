export default {

formLoaded()
{
    $('#page-loader').remove()

    window.addEventListener('focus', (e) => {
        let timeDiff = Date.now() - window.loadPageAt
        
        if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
            axios.get('/is-session-active')
                 .then((response) => {
                    if ( !response.data.active ) {
                        console.log('show-common-dialog => error-419')
                        window.loadPageAt = 419
                        window.app.hello()
                    }
                 })
        }
    })

},

responseErrorHandle(error)
{
    if (this.error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        if ( this.error.response.status == 419 ) {
            console.log('Error', this.error.message)
        } else if ( this.error.response.status == 500 ) {
            console.log('Error', this.error.message)
        }
    } else if (this.error.request) {
        // The request was made but no response was received
        // `this.error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        console.log(this.error.request)
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', this.error.message)
    }
    console.log(this.error.config)
}

}
