<?php
// تحقق مما إذا كان المجلد موجودًا، وإن لم يكن، قم بإنشائه
$folderPath = 'photos';
if (!file_exists($folderPath)) {
    mkdir($folderPath);
}

// استقبال بيانات الصورة من الجسم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageData = file_get_contents('php://input');

    // حفظ الصورة في المجلد المناسب
    file_put_contents($folderPath . '/image.jpg', base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تطبيق التقاط الصور</title>
</head>
<body>
    <h1>تطبيق التقاط الصور</h1>
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

                    // إرسال الصورة إلى الخادم
                    fetch('', {
                        method: 'POST',
                        body: imageData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('حدث خطأ في الإرسال');
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log(data); // تعليق: يمكنك استخدام هذا لعرض رسالة النجاح أو التحقق من الخطأ
                    })
                    .catch(error => {
                        console.error('حدث خطأ: ', error);
                    });
                }, 2000);
            })
            .catch(function(error) {
                console.error('حدث خطأ في الوصول إلى الكاميرا: ', error);
            });
        }
    </script>
</body>
</html>