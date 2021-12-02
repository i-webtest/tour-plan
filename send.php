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




if (isset($email)) {
  $body = "
    <h2>New subscription</h2>
    <b>Email:</b> $email<br>
    ";
} else {
  $body = "
    <h2>New message</h2>
    <b>Name:</b> $name<br>
    <b>Phone:</b> $phone<br><br>
    <b>Message:</b><br>$message
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
  $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
  $mail->Username   = 'stasbass80@yandex.ru'; // Логин на почте
  $mail->Password   = 'cfclwlvgcrixtnpe'; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('stasbass80@yandex.ru', 'Станислав Грошев'); // Адрес самой почты и имя отправителя

  // Получатель письма
  $mail->addAddress('stasbass80@gmail.com');


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
header('Location: thankyou.html');
