<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_welcome_email($to_email, $username) {
    $mail = new PHPMailer(true); 

    try {
        // Server settings
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.example.com';                   
        $mail->SMTPAuth   = true;                              
        $mail->Username   = 'your_email@example.com';            
        $mail->Password   = 'your_password';                   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      
        $mail->Port       = 587;                                 


        $mail->setFrom('noreply@ics.com', 'ICS Admin');
        $mail->addAddress($to_email, $username);              
        $mail->isHTML(true);                                      
        $mail->Subject = "Welcome to ICS 2.2! ACCOUNT VERIFICATION";
        $mail->Body    = "Hello " . htmlspecialchars($username) . ",<br><br>In order to use this account you need to click <a href='http://example.com/verify?email=$to_email'>here</a> to complete the registration process.<br><br>Regards,<br>Systems admin<br>ICS 2.2";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (send_welcome_email("your-email@example.com", "Test User")) {
    echo "Mail sent.";
} else {
    echo "Mail not sent.";
}
?>
