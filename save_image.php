<?php


// المسار الذي تود حفظ الصورة به على السيرفر
$save_path = 'C:\Users\عبدالله بوصلحه\Documents\GitHub\klerf';

// استقبال الصورة المرسلة عبر الـ POST
$imageData = $_POST['imageData'];

// تحويل الصورة من النص إلى الصيغة الصحيحة باستخدام دالة base64_decode
$image = base64_decode($imageData);

// تحديد نوع محتوى الصورة باستخدام دالة mime_content_type
$image_type = mime_content_type("data://{$imageData}");

// تحديد امتداد الملف المناسب عند حفظ الصورة على السيرفر
$extensions = [
    'image/gif' => '.gif',
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/bmp' => '.bmp',
    'image/webp' => '.webp',
];
$extension = $extensions[$image_type] ?? '';

// انشاء اسم جديد للملف باستخدام دالة uniqid
$new_file_name = uniqid('image_') . $extension;

// حفظ الصورة على السيرفر باستخدام الاسم الجديد للملف
if (file_put_contents($save_path . $new_file_name, $image)) {
    echo "تم حفظ الصورة على السيرفر بنجاح!";
} else {
    echo "حدث خطأ أثناء حفظ الصورة على السيرفر.";
}



?>
