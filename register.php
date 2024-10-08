<?php
include('db.php');

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']); 
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email.';
    } else {
    
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $errors[] = 'This email is already registered.';
        } else {
        
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
        
            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $email, $hashed_password]);

            include('mail.php');
            $mail_success = send_welcome_email($email, $username);

        
            if ($mail_success) {
                $success = 'You have successfully registered! A confirmation email has been sent to you.';
            } else {
                $errors[] = 'Registration successful, but failed to send the confirmation email.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Sign Up</h2>
    <?php if (!empty($errors)): ?>
        <ul><?php foreach ($errors as $error) echo "<li>$error</li>"; ?></ul>
    <?php elseif ($success): ?>
        <p><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
