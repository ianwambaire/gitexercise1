<?php
function send_welcome_email($to_email, $username) {
    $subject = "Welcome to ICS 2.2! ACCOUNT VERIFICATION";
    $message = "Hello " . $username . ",\n\nIn order to use this account you need to click here to complete registration process\n\nRegards,\nSystems admin/nICS 2.2";
    $headers = "From: noreply@ics.com";

    return mail($to_email, $subject, $message, $headers);
}
?>
