<?php
$host = 'localhost';
$dbname = 'internet'; 
$user = 'root';  
$pass = 'oliviamumbi2010'; 
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=internet", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database";
} catch (PDOException $e) {
    
    die("Connection failed: " . $e->getMessage());
}
?>
