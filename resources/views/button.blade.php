<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
    {{-- 
    <style>
            html{
                      width: 100%;
                      height: 100%;
                      }
            body{
                          background: black;
            }
            .container{
                      position: absolute;
                      top: 30%;
                      left: 50%;
                      transform: translate(-50%);
                      width: auto;
                      max-width: 350px;
                      
                      text-align: left;
                      }
            a{
                      text-decoration: none;
                     } 
            .button{
                      position: relative;
                      padding: 15px 25px;
                      
                      color: yellow;
                      text-transform: uppercase;
                      background-color: transparent;
                      border: 3px solid yellow;
                      &:hover
                        cursor: pointer;
                      }
            .button-effect{
                      display: inline-block;
                      overflow: hidden;
                      }
            .effect-wave{
                      display: block;
                      position: absolute;
                      transform: translateX(-50%) translateY(-50%);
                      width: 0px;
                      height: 0px;
            
                      background-color: yellow;
                      border-radius: 50%;
                      opacity: 0.5;
                  }
    </style>
     --}}

    <style>
        *, *:before, *:after{
            box-sizing: border-box;
            margin: 0; padding: 0;
        }

        section{
            width: 30%;
            margin: 15% auto;
            background: #f2f2f2;
            padding: 5%;
        }

        button{
            border: 3px solid #222;
            background: transparent;
            overflow: hidden;
            width: 100%;
            outline: none;
        }

        button span {

            font-weight: 700;
            font-size: 1.5em;
            color: #222;

            display: block; 
            user-select: none;
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        button span:hover {
            cursor: pointer;
        }

        .circle{
            display: block; 
            position: absolute;
            background: rgba(0,0,0,.075);
            border-radius: 50%;
            transform: scale(0);
        }

        .circle.animate{animation: effect 0.65s linear;}

        @keyframes effect {
            100% {
                opacity: 0;
                transform: scale(2.5);
            }
        }
    </style>
    <title>Button</title>
</head>
<body>
{{-- 
    <div class="container">
        <a href="#" class="button button-effect">Click me</a>
        <a href="#" class="button button-effect">Click me again</a>
        <a href="#" class="button button-effect">No, not him. Click me rather...</a>
    </div>
    
    <script>
        $('.button-effect').on('click', function(e) {
          e.preventDefault();
          var self = $(this),
              wave = '.effect-wave',
              /* Get the width of button (if different buttons types) */
              btnWidth = self.outerWidth(),
              x = e.offsetX,
              y = e.offsetY;

          self.prepend('<span class="effect-wave"></span>')

          $(wave)
            .css({
              'top': y,
              'left': x
            })
            .animate({
              opacity: '0',
              width: btnWidth * 2,
              height: btnWidth * 2
            }, 500, function() {
             self.find(wave).remove()
            })
        })
    </script>
     --}}

     <section>
        <button><span>button</span></button>
     </section>

     <script>
         
        $("button span").click(function(e){
            var element, circle, d, x, y;

            element = $(this);

            console.log(element);

            if(element.find(".circle").length == 0)
                element.prepend("<span class='circle'></span>");

            circle = element.find(".circle");
            circle.removeClass("animate");

            if(!circle.height() && !circle.width()) {
                d = Math.max(element.outerWidth(), element.outerHeight());
                circle.css({height: d, width: d});
            }

            x = e.pageX - element.offset().left - circle.width()/2;
            y = e.pageY - element.offset().top - circle.height()/2;

            circle.css({top: y+'px', left: x+'px'}).addClass("animate");
        })
     </script>
</body>
</html>
