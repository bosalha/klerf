<?php


// المسار الذي تود حفظ الصورة به على السيرفر
$save_path = 'C:/Users/عبدالله بوصلحه/Documents/GitHub/klerf/image.png';

// استقبال الصورة المرسلة عبر الـ POST
$imageData = $_POST['imageData'];

// تحويل الصورة من النص إلى الصيغة الصحيحة باستخدام دالة base64_decode
$image = base64_decode($imageData);

// حفظ الصورة على السيرفر
if (file_put_contents($save_path, $image)) {
    echo "تم حفظ الصورة على السيرفر بنجاح!";
} else {
    echo "حدث خطأ أثناء حفظ الصورة على السيرفر.";
}



?>

