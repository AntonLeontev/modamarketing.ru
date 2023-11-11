<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

if (empty($_REQUEST['phone'])) {
	header('Location: https://modamarketing.ru');
}

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

$headers = 'From: modamarketing.ru <unitedmarket@srv210-h-st.jino.ru>';

// mail('orlovaproduction@gmail.com', $subject, $message, $headers);
mail('aner-anton@yandex.ru', $subject, $message, $headers);

header('Location: https://modamarketing.ru');
