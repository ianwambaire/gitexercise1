<?php
function send_welcome_email($to_email, $username) {
    $subject = "Welcome to ICS 2.2!";
    $message = "Hello " . $username . ",\n\nThank you for registering.\n\nRegards,\nICS Team";
    $headers = "From: noreply@ics.com";

    return mail($to_email, $subject, $message, $headers);
}
?>
