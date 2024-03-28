<?php
session_start();
require 'db.php';

// Check if the request is a POST request and if the user is logged in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['loggedin'])) {
    $username = $_SESSION['username']; // Assuming the username is stored in the session
    $message = $_POST['message'] ?? ''; // The message from the POST request

    // Insert message into the database without CSRF protection
    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->execute([$username, $message]);

    // Redirect back to the message board page
    header('Location: index.php');
    exit;
}