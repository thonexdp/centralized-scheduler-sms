<html>
    <head>
    <style>
    #preview {
    background: red;
    border: 1px solid green;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />

    <script type="text/javascript">
         $(document).delegate(':file', 'change', function() {
            picture(this);
            console.log('running');
        });

         //$(document).delegate(':form', 'change', function() {

        var picture_width;
        var picture_height;
        var crop_max_width = 300;
        var crop_max_height = 300;
        function picture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#jcrop, #preview").html("").append("<img src=\""+e.target.result+"\" alt=\"\" />");
                    picture_width = $("#preview img").width();
                    picture_height = $("#preview img").height();
                    $("#jcrop  img").Jcrop({
                        onChange: canvas,
                        onSelect: canvas,
                        boxWidth: crop_max_width,
                        boxHeight: crop_max_height
                    });
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        function canvas(coords){
            var imageObj = $("#jcrop img")[0];
            var canvas = $("#canvas")[0];
            canvas.width  = coords.w;
            canvas.height = coords.h;
            var context = canvas.getContext("2d");
            context.drawImage(imageObj, coords.x, coords.y, coords.w, coords.h, 0, 0, canvas.width, canvas.height);
            png();
        }
        function png() {
            var png = $("#canvas")[0].toDataURL('image/png');
            $("#png").val(png);
        }
        function dataURLtoBlob(dataURL) {
            var BASE64_MARKER = ';base64,';
            if(dataURL.indexOf(BASE64_MARKER) == -1) {
                var parts = dataURL.split(',');
                var contentType = parts[0].split(':')[1];
                var raw = decodeURIComponent(parts[1]);

                return new Blob([raw], {type: contentType});
            }
            var parts = dataURL.split(BASE64_MARKER);
            var contentType = parts[0].split(':')[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);
            for(var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], {type: contentType});
        }
    </script>
    </head>
    <body>
       <form id="form">
        <h2>Image file select</h2>
        <input id="file" type="file" onchange="imageLoad()" />
        <h2>Uploaded Image</h2>
        <div id="jcrop"></div>
        <h2>Cropped Image</h2>
        <canvas id="canvas"></canvas>
        <input id="png" type="hidden" />
        <h2>Submit form</h2>
        <input type="submit" value="Upload form data and image" />
       </form>
    </body>
</html>