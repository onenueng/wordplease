class ResponseErrorHandler {
    
    constructor(error) {
        this.error = error
    }

    handle() {
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

module.exports = ResponseErrorHandler
