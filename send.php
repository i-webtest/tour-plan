<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Формирование самого письма
$title = "New message Best Tour Plan";




// if (isset($email)) {
//   $body = "
//     <h2>New subscription</h2>
//     <b>Email:</b> $email<br>
//     ";
// } else {
//   $body = "
//     <h2>New message</h2>
//     <b>Name:</b> $name<br>
//     <b>Phone:</b> $phone<br><br>
//     <b>Message:</b><br>$message
//     ";
// };

if ($name & $email) {
  $body = "
    <h2>New message</h2>
    <b>Name:</b> $name<br>
    <b>Phone:</b> $phone<br>
    <b>Email:</b> $email<br><br>
    <b>Message:</b><br>$message
    ";
} else if ($name & $message) {
  $body = "
    <h2>New message</h2>
    <b>Name:</b> $name<br>
    <b>Phone:</b> $phone<br><br>
    <b>Message:</b><br>$message
    ";
} else {
  $body = "
    <h2>New subscription</h2>
    <b>Email:</b> $email<br>
    ";
};

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;
  // $mail->SMTPDebug = 2;
  $mail->Debugoutput = function ($str, $level) {
    $GLOBALS['status'][] = $str;
  };

  // Настройки вашей почты
  $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
  $mail->Username   = 'iweb_test@mail.ru'; // Логин на почте
  $mail->Password   = 'p6Jj9XtfhNZD36rgZtcE'; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('iweb_test@mail.ru', 'Станислав Грошев'); // Адрес самой почты и имя отправителя

  // Получатель письма
  if (!isset($user_email)) {
    $mail->addAddress('info@iwebtest.ru');
  } else {
    $mail->addAddress('info@iwebtest.ru');
  };


  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;



  // Проверяем отравленность сообщения
  if ($mail->send()) {
    $result = "success";
  } else {
    $result = "error";
  }
} catch (Exception $e) {
  $result = "error";
  $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

header('Location: thankyou.html');
