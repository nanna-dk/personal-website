<?php
// If the form was submitted
include_once (realpath(__DIR__ . '/../db.php'));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
error_reporting(E_ALL);
//var_dump($_POST);
    // If the Google Recaptcha box was clicked
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
        $secret  = '6LdqpBIUAAAAAFQF5a2Enla1sI0xAlN6xWsn4iST';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'secret' => $secret,
                'response' => $captcha,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $output = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($output);
        //var_dump($obj);
        // If the Google Recaptcha check was successful
        if($obj->success == true) {
          $name = strip_tags(trim($_POST["name"]));
          $name = filter_var($name, FILTER_SANITIZE_STRING);
          $name = str_replace(array("\r","\n"),array(" "," "),$name);
          $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
          $message = trim($_POST["message"]);
          $ip = $_SERVER['REMOTE_ADDR'];
          if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Udfyld venligst alle felterne.";
            exit;
          }
          $recipient = $adminMail;
          $subject = "Besked fra $name";
          $body = "<p><strong>Navn:</strong> ". $name ."</p>";
          $body .= "<p><strong>E-mail:</strong> ". $email ."</p>";
          $body .= "<p><strong>IP-adresse:</strong> ". $ip ."</p>";
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
          $headers .= 'From:' . $name . ' <' . $email . '>' . "\r\n";
          $headers .= 'Reply-To:'  . $name . ' <' . $email . '>' . "\r\n";
          if (mail($recipient, $subject, $body, $headers)) {
            http_response_code(200);
            echo "Tak! Din besked er blevet sendt.";
          }

          else {
            http_response_code(500);
            echo "Beskeden kunne ikke sendes. Prøv igen.";
          }
      }

      // If the Google Recaptcha check was not successful
      else {
        http_response_code(400);
        echo "Verificeringen fejlede. prøv igen.";
      }
  }

  // If the Google Recaptcha box was not clicked
  else {
    http_response_code(400);
    echo "Klik venligst på reCaptcha-boksen.";
  }
}

// If the form was not submitted
// Not a POST request, set a 403 (forbidden) response code.
else {
  http_response_code(403);
  echo "Formularen blev ikke sendt korrekt. Prøv igen.";
}
?>
