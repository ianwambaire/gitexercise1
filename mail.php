<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_welcome_email($to_email, $username) {
    $mail = new PHPMailer(true); 

    try {
        // Server settings
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;                              
        $mail->Username   ='iannganga154@gmail.com'; 
        $mail->Password   = '##oliviamumbi2010';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      
        $mail->Port       = 587;                                 

        // Recipients
        $mail->setFrom('noreply@ics.com', 'ICS Admin');
        $mail->addAddress($to_email, htmlspecialchars($username));              

        // Content
        $mail->isHTML(true);                                      
        $mail->Subject = "Welcome to ICS 2.2! ACCOUNT VERIFICATION";
        $mail->Body    = "Hello " . htmlspecialchars($username) . ",<br><br>In order to use this account you need to click <a href='http://example.com/verify?email=" . urlencode($to_email) . "'>here</a> to complete the registration process.<br><br>Regards,<br>Systems admin<br>ICS 2.2";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail Error: " . $e->getMessage());  // Log error for debugging
        return false;
    }
}
?>
