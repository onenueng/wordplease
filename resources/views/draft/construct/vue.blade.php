<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    
    <title>test vue</title>
</head>
<body>
    <div class="container-fluid" id="app">
        <form method="POST" action="/test-post">
            {{ csrf_field() }}

            
            <input-text name="an" value="12345678" label="an :"></input-text>

            <button class="btn btn-primary">Go</button>
            
        </form>
    </div>

    <!-- jQuery 3.2.1 -->
    <script type="text/javascript" src="/js/jquery.slim.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <!-- vue 2.5.1 -->
    <script type="text/javascript" src="/js/vue.js"></script>
    
    <script>
        Vue.component('input-text',{
            props: ['name', 'value', 'label'],
            template: `
                <div class="form-group">
                    <label class="control-label" for="name">@{{ label }}</label>
                    <input type="text" class="form-control" :name="name" v-model="userInput" @input="fx()" />
                </div>
            `,
            data () {
                return {
                    userInput: ''
                }
            },
            mounted () {
                this.userInput = this.value;
            },
            methods: {
                fx () {
                    console.log(this.userInput);
                }
            }
        });

        new Vue({
            el: '#app'
        })
    </script>
</body>
</html>
