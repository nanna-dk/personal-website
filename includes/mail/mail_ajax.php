<?php

// If the form was submitted
include_once realpath(__DIR__.'/../db.php');
include_once realpath(__DIR__.'/../functions.php');
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    //error_reporting(E_ALL);
    //var_dump($_POST);
    // If the Google Recaptcha token is sent:
    if (isset($_POST['recaptcha']) && ! empty($_POST['recaptcha'])) {
        $captcha = $_POST['recaptcha'];
        $secret = $captcha_secret_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'secret' => $secret,
                'response' => $captcha,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ],
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $output = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($output, true);
        //var_dump($response);
        // If the Google Recaptcha check was successful
        if ($response['success'] && $response['score'] >= 0.5) {
            date_default_timezone_set('Europe/Copenhagen');
            $time = date('d. m. Y, H:i:s');
            $name = strip_tags(trim($_POST['name']));
            $name = filter_var($name, FILTER_SANITIZE_STRING);
            $name = str_replace(["\r", "\n"], [' ', ' '], $name);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
            $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
            if (empty($name) or empty($message) or ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo 'Udfyld venligst alle felterne.';
                exit;
            }
            $recipient = $adminMail;
            $subject = siteUrl() . ": Besked fra $name";
            $body = '<p><strong>Navn:</strong> '.$name.'</p>';
            $body .= '<p><strong>E-mail:</strong> '.$email.'</p>';
            $body .= '<p><strong>Dato/tid:</strong> '.$time.'</p>';
            $body .= '<p><strong>IP-adresse:</strong> '.$ip.'</p>';
            $body .= '<p><strong>Besked:</strong> '.$message.'</p>';
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8'."\r\n";
            $headers .= 'X-Mailer: PHP/'.phpversion()."\r\n";
            $headers .= 'From:'.$name.' <'.$email.'>'."\r\n";
            $headers .= 'Reply-To:'.$name.' <'.$email.'>'."\r\n";
            if (mail($recipient, $subject, $body, $headers)) {
                http_response_code(200);
                echo 'Tak! Din besked er blevet sendt.';
            } else {
                http_response_code(500);
                echo 'Beskeden kunne ikke sendes. Prøv igen.';
            }
        }
        // If the Google Recaptcha check was not successful
        else {
            http_response_code(400);
            echo 'Verificeringen fejlede. prøv igen.';
        }
    }
    // If the Google Recaptcha box was not clicked
    else {
        http_response_code(400);
        echo 'Captcha skal valideres.';
    }
}
// If the form was not submitted
// Not a POST request, set a 403 (forbidden) response code.
else {
    http_response_code(403);
    echo 'Formularen blev ikke sendt korrekt. Prøv igen.';
}
?>
