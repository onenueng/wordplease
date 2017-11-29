<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500);

        body {
          min-height: 100vh;  
          overflow: hidden;
          font-family: Roboto;
          color: #fff;
        }

        h1 {
          font: 200 60px Roboto;
          text-align: center;
        }

        p.credits {
          text-align: center;
          margin-top: 100px;
        }

        .credits img {
          border-radius: 50%;
          width: 100px;
        }

        .container {
          bottom: 0;
          position: fixed;
          margin: 1em;
          right: 0px;
        }

        .buttons {
          box-shadow: 0px 5px 11px -2px rgba(0, 0, 0, 0.18), 
                      0px 4px 12px -7px rgba(0, 0, 0, 0.15);
          background: #00BCD4;
          border-radius: 50%;
          display: block;
          width: 56px;
          height: 56px;
          margin: 20px auto 0;
          position: relative;
          -webkit-transition: all .1s ease-out;
                  transition: all .1s ease-out;  
        }

        .buttons:active, 
        .buttons:focus, 
        .buttons:hover {
          box-shadow: 0 0 4px rgba(0,0,0,.14),
            0 4px 8px rgba(0,0,0,.28);
        }

        .buttons:not(:last-child) {
          width: 40px;
          height: 40px;
          margin: 20px auto 0;
          opacity: 0;
          -webkit-transform: translateY(50px);
              -ms-transform: translateY(50px);
                  transform: translateY(50px);
        }

        .container:hover 
        .buttons:not(:last-child) {
          opacity: 1;
          -webkit-transform: none;
              -ms-transform: none;
                  transform: none;
          margin: 15px auto 0;
        }

        /* Unessential styling for sliding up buttons at differnt speeds */

        .buttons:nth-last-child(1) {
          -webkit-transition-delay: 25ms;
                  transition-delay: 25ms;
          /*background-image: url('https://cbwconline.com/IMG/Share.svg');
          background-size: contain;*/
        }

        .buttons:not(:last-child):nth-last-child(2) {
          -webkit-transition-delay: 50ms;
                  transition-delay: 20ms;
          background-image: url('https://cbwconline.com/IMG/Facebook-Flat.png');
          background-size: contain;
        }

        .buttons:not(:last-child):nth-last-child(3) {
          -webkit-transition-delay: 75ms;
                  transition-delay: 40ms;
          background-image: url('https://cbwconline.com/IMG/Twitter-Flat.png');
          background-size: contain;
        }

        .buttons:not(:last-child):nth-last-child(4) {
          -webkit-transition-delay: 100ms;
                  transition-delay: 60ms;
          background-image: url('https://cbwconline.com/IMG/Google%20Plus.svg');
          background-size: contain;
        }

        /* Show tooltip content on hover */

        [tooltip]:before {
          bottom: 25%;
          font-family: arial;
          font-weight: 600;
          border-radius: 2px;
          background: #585858;
          color: #fff;
          content: attr(tooltip);
          font-size: 12px;
          visibility: hidden;
          opacity: 0;
          padding: 5px 7px;
          margin-right: 12px;
          position: absolute;
          right: 100%;
          white-space: nowrap;
        }

        [tooltip]:hover:before,
        [tooltip]:hover:after {
          visibility: visible;
          opacity: 1;
        }
        i {
            margin: 0;
            /*background: yellow;*/
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
    </style>

    <
    <title>FBA</title>
</head>
<body>
    

    <nav class="container"  > 
    
        <a href="#" class="buttons" tooltip="Google+"></a>
        
        <a href="#" class="buttons" tooltip="Twitter"></a>
        
        <a href="#" class="buttons" tooltip="Facebook"></a>

        <a class="buttons" tooltip="Share" href="#"><i class="fa fa-save"></i></a>

  </nav>

    
</body>
</html>
