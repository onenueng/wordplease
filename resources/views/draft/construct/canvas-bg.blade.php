<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>CANVAS BG</title>
</head>
<body>
    <h1>hello bg</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus asperiores quasi voluptatibus qui eveniet? Dignissimos eveniet cumque, doloremque, sed aperiam reprehenderit vero consequatur excepturi laborum a delectus provident. Totam, deserunt.</p>

    <script src="/js/test/canvas2svg.js"></script>
    <script>
        var scale = window.devicePixelRatio || 1;
        var width = 150;
        var height = 40;

        var canvas = document.createElement('canvas');
        var canvasContext = canvas.getContext('2d');

        canvas.width = width * scale;
        canvas.height = height * scale;

        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';

        canvasContext.scale(scale, scale);
        
        canvasContext.font = "6px Consolas";
        canvasContext.fillStyle = "rgba(160, 160, 160, 0.3)";
        canvasContext.rotate(-10 * Math.PI / 180);
        canvasContext.fillText("koramit@wesdckdjsi", 10, 40);

        // document.body.style.background = 'url(' + canvas.toDataURL() + ')';

        var ctx = new C2S(150,40); //width, height of your desired svg file
        //do your normal canvas stuff:
        ctx.font = "10px Consolas";
        ctx.fillStyle = "rgba(160, 160, 160, 0.3)";
        ctx.rotate(-10 * Math.PI / 180);
        ctx.fillText("koramit@wesdckdjsi", 10, 40);
        //ok lets serialize to SVG:
        var myRectangle = ctx.getSerializedSvg(true);
        document.body.style.background = 'url(\'data:image/svg+xml;utf8,' + myRectangle + '\')';
    </script>
</body>
</html>
