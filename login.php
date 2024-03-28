<?php
// login_vulnerable.php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? ''; 

    // Vulnerable SQL query
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = $pdo->query($sql); // This line is vulnerable to SQL injection

    if ($stmt->rowCount() > 0) {
        // User authenticated
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        // User not authenticated
        $_SESSION['error'] = 'Invalid username or password.';
        header('Location: index.php');
        exit;
    }
}