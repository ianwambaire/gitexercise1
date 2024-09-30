<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');
$query = "SELECT * FROM users ORDER BY username ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <h3>Registered Users:</h3>
    <ol><?php foreach ($users as $user) echo "<li>" . htmlspecialchars($user['username']) . "</li>"; ?></ol>
    <a href="logout.php">Logout</a>
</body>
</html>
