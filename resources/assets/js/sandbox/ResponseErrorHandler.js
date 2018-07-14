class ResponseErrorHandler {
    
    construtor() {}

    handle(error) {
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            if ( error.response.status == 419 ) {
                console.log('Error', error.message)
            } else if ( error.response.status == 500 ) {
                console.log('Error', error.message)
            }
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request)
        } else {
            // Something happened in setting up the request that triggered an Error
            console.log('Error', error.message)
        }
        console.log(error.config)
    }
}

module.exports = ResponseErrorHandler
