<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);
	//Від кого лист
	$mail->setFrom('from@gmail.com', 'Мийка килимів'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('dmitrobogumil@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Нове замовлення з сайту';

	// Формуємо тіло листа як сучасну стилізовану таблицю
	$body = '<div style="background:#f7f7f9;padding:32px 0;font-family:Arial,sans-serif;">
  <div style="max-width:480px;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 2px 16px rgba(0,0,0,0.07);padding:32px 24px;">
    <h2 style="margin-top:0;margin-bottom:24px;font-size:26px;color:#2d3748;text-align:center;letter-spacing:0.5px;">Нове замовлення</h2>';
	if (!empty($_POST)) {
	    $body .= '<table style="width:100%;border-collapse:collapse;font-size:16px;">';
	    foreach ($_POST as $key => $value) {
	        $key = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
	        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	        $body .= '<tr>';
	        $body .= '<td style="padding:10px 8px;border-bottom:1px solid #f0f0f0;color:#718096;width:40%;font-weight:600;">' . $key . '</td>';
	        $body .= '<td style="padding:10px 8px;border-bottom:1px solid #f0f0f0;color:#2d3748;">' . $value . '</td>';
	        $body .= '</tr>';
	    }
	    $body .= '</table>';
	}
	$body .= '<div style="margin-top:32px;text-align:center;color:#a0aec0;font-size:13px;">myika.com.ua</div>';
	$body .= '</div></div>';

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>