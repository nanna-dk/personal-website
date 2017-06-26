<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])):
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        $secret         = '6LdqpBIUAAAAAFQF5a2Enla1sI0xAlN6xWsn4iST';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData   = json_decode($verifyResponse);
        $contact_name   = !empty($_POST['contact_name']) ? $_POST['contact_name'] : '';
        $contact_name   = test_input($contact_name);
        $email          = !empty($_POST['email']) ? $_POST['email'] : '';
        $email          = test_input($email);
        $phone   = !empty($_POST['phone']) ? $_POST['phone'] : '';
        $phone          = test_input($phone);
        $message        = !empty($_POST['message']) ? $_POST['message'] : '';
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)): //make sure the email address is valid
            $email = $email;
            if ($responseData->success):
            //contact form submission code
                $to          = 'nanna@e-nanna.dk';
                $subject     = 'Website kontaktformular';
                $htmlContent = "
                                <p><b>Navn: </b>" . $contact_name . "</p>
                                <p><b>Evt. tlf.: </b>" . $phone . "</p>
                                <p><b>E-mail: </b>" . $email . "</p>
                                <p><b>Besked: </b>" . $message . "</p>";
                //set content-type for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                $headers .= 'From:' . $contact_name . ' <' . $email . '>' . "\r\n";
                //$headers .= 'Cc:' . $contact_name . ' <' . $email . '>' . "\r\n";
                $headers .= 'Reply-To:'  . $contact_name . ' <' . $email . '>' . "\r\n";
                //send email
                @mail($to, $subject, $htmlContent, $headers);
                $succMsg      = 'Tak for din besked. Jeg svarer hurtigst muligt.';
                $contact_name = '';
                $phone        = '';
                $email        = '';
                $message      = '';
                echo "<script>$(function(){
                          $('#response').modal('show');
                      });</script>";
            else:
                $errMsg = 'Verifikation ikke godkendt. Prøv igen.';
            endif;
        else:
            $errMsg = 'Ugyldig e-mailadresse';
        endif;
    else: //re-display content if error
        $contact_name = $_POST['contact_name'];
        $phone       = $_POST['phone'];
        $email        = $_POST['email'];
        $message      = $_POST['message'];
        $errMsg       = 'Afkryds venligst feltet "Jeg er ikke en robot".';
    endif;
else:
    $errMsg       = '';
    $succMsg      = '';
    $contact_name = '';
    $email        = '';
    $phone        = '';
    $message      = '';
endif;
?>
