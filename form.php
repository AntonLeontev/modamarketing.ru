<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if (empty($_REQUEST['phone'])) {
	header('Location: /');
}

$recipients = [
	'orlovaproduction@gmail.com',
	// 'aner.anton@gmail.com',
];

$mail = new PHPMailer(true);

$subject = 'Заявка с сайта modamarketing.ru';
$message = "Новая заявка:\n\n";

if (!empty($_REQUEST['name'])) {
	$message .= "Имя: {$_REQUEST['name']}\n";
}
if (!empty($_REQUEST['email'])) {
	$message .= "Почта: {$_REQUEST['email']}\n";
}
if (isset($_REQUEST['phone'])) {
	$message .= "Телефон: {$_REQUEST['phone']}\n";
}

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); 
	$mail->CharSet    = 'UTF-8';                                           //Send using SMTP
    $mail->Host       = 'smtp.jino.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@modamarketing.ru';                     //SMTP username
    $mail->Password   = 'modamark568Test';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@modamarketing.ru', 'modamarketing.ru');

	foreach ($recipients as $recipient) {
		$mail->addAddress($recipient);     //Add a recipient
	}

    //Content
    $mail->isHTML(false);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
	header('Location: /');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

