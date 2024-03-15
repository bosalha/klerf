<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>هلو وورلد</title>
</head>
<body>
    <h1>هلو وورلد</h1>
    <button onclick="requestCameraPermission()">اطلب تصريح الوصول إلى الكاميرا</button>
    <div id="cameraOutput"></div>

    <script>
        function requestCameraPermission() {
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                var video = document.createElement('video');
                video.srcObject = stream;
                video.play();

                var outputDiv = document.getElementById('cameraOutput');
                outputDiv.appendChild(video);

                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                setTimeout(function() {
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    var imageData = canvas.toDataURL('image/jpeg');

                    var image = document.createElement('img');
                    image.src = imageData;
                    outputDiv.appendChild(image);
                }, 2000);
            })
            .catch(function(error) {
                console.error('حدث خطأ في الوصول إلى الكاميرا: ', error);
            });
        }
    </script>
</body>
</html>