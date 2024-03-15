<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة HTML مع كود PHP</title>
</head>
<body>
    <h1>تطبيق تصوير الصور</h1>
    <!-- استمرار العرض العادي h -->
    
    <?php
    // الكود PHP هنا
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    // استقبال بيانات الصورة من الجسم
    $imageData = file_get_contents('php://input');

    // إنشاء كائن PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // تكوين الإعدادات
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com'; // خادم البريد الإلكتروني لـ Outlook
    $mail->SMTPAuth = true;
    $mail->Username = 'a_b@outlook.sa'; // عنوان بريدك الإلكتروني
    $mail->Password = 'Wael_1313'; // كلمة مرور حساب بريدك الإلكتروني
    $mail->SMTPSecure = 'tls'; // يمكنك تغييرها إلى 'ssl' إذا لزم الأمر
    $mail->Port = 587; // منفذ خادم البريد الإلكتروني

    $mail->setFrom('a_b@outlook.sa', 'Your Name'); // عنوان بريدك الإلكتروني واسمك
    $mail->addAddress('a_b@outlook.sa'); // تعديل البريد ليكون نفس بريدك الإلكتروني

    // إعداد محتوى البريد الإلكتروني
    $mail->Subject = 'New Photo';
    $mail->Body = 'Please find the attached photo.';
    $mail->isHTML(false);

    // إرفاق الصورة كمرفق
    $mail->addStringAttachment($imageData, 'image.jpg');

    // إرسال البريد الإلكتروني
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent successfully';
    }
    ?>

</body>
</html>