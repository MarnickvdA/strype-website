<?php
  $contact_email_to = "info@strype.nl";
  $subject_title = "Someone wants to get in touch";
  $email_title = "Email:";
  $contactType_title = "Reason for contacting:";
  $message_title = "Message:";

  if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die('Sorry Request must be Ajax POST');
  }

  if(isset($_POST)) {

      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      $contactType = filter_var($_POST["contactType"], FILTER_SANITIZE_STRING);
      $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

      if(!$email){
        die($contact_error_email);
      }

      if(!isset($contact_email_from)) {
        $contact_email_from = "no-reply@" . @preg_replace('/^www\./','', $_SERVER['SERVER_NAME']);
      }

      $headers = 'From: Strype Contact Form <' . $contact_email_from . '>' . PHP_EOL;
      $headers .= 'Reply-To: ' . $contact_email_from . PHP_EOL;
      $headers .= 'MIME-Version: 1.0' . PHP_EOL;
      $headers .= 'Content-Type: text/html; charset=UTF-8' . PHP_EOL;
      $headers .= 'X-Mailer: PHP/' . phpversion();

      $message_content .= '<strong>' . $email_title . '</strong> ' . $email . '<br>';
      $message_content .= '<strong>' . $contactType_title . '</strong> ' . $contactType . '<br>';
      $message_content .= '<strong>' . $message_title . '</strong> ' . nl2br($message);

      $sendemail = mail($contact_email_to, $subject_title . ' ' . $subject, $message_content, $headers);

      if( $sendemail ) {
        echo 'OK';
      } else {
        echo 'Could not send mail!';
      }
    }
  ?>
