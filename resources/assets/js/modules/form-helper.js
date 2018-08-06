export default {

loaded()
{
    window.addEventListener('focus', (e) => {
        let timeDiff = Date.now() - window.loadPageAt

        if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
            axios.get('/is-session-active')
                 .then((response) => {
                    if ( !response.data.active ) {
                        window.app.$refs.root.modalDialogueMessage = 'Session timeoute, Please reload this page to continue.'
                        window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
                        window.app.$refs.root.modalDialogueToggle = true
                    }
                 })
        }
    })

    document.getElementsByTagName("BODY")[0].removeChild(document.getElementById("page-loader"))
},

responseErrorHandle(error)
{
    if ( error.response ) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        if ( error.response.status == 419 ) {
            window.app.$refs.root.modalDialogueMessage = 'Session timeoute, Please reload this page to continue.'
            window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
            window.app.$refs.root.modalDialogueToggle = true
        } else if ( error.response.status == 500 ) {
            window.app.$refs.root.modalDialogueMessage = 'Server error, Please try again later or get the Helpdesk.'
            window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
            window.app.$refs.root.modalDialogueToggle = true
        } else {
            window.app.$refs.root.modalDialogueMessage = 'You should never see this, Please try again later or get the Helpdesk.'
            window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
            window.app.$refs.root.modalDialogueToggle = true
        }
    } else if ( error.request ) {
        // The request was made but no response was received
        // `this.error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        window.app.$refs.root.modalDialogueMessage = 'Cannot connect to server, Please try again later or get the Helpdesk.'
        window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
        window.app.$refs.root.modalDialogueToggle = true
    } else {
        // Something happened in setting up the request that triggered an Error
        window.app.$refs.root.modalDialogueMessage = 'You should never see this, Please try again later or get the Helpdesk.'
        window.app.$refs.root.modalDialogueHeading = 'Attention please !!'
        window.app.$refs.root.modalDialogueToggle = true
        console.log(error)
    }
}

}
