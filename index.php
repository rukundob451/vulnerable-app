<?php
session_start();
require 'messages.php';

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>
    <!-- Include Tailwind CSS from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <?php if ($loggedin): ?>

            <h1 class="text-2xl font-bold mb-6">Welcome,
                <?= htmlspecialchars($_SESSION['username']) ?>!
            </h1>
            <form action="logout.php" method="POST">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Logout
                </button>
            </form>
            <br>

            <h1 class="text-2xl font-bold mb-6">Message Board</h1>
            <form action="post_message.php" method="POST" class="mb-6">
                <input type="text" name="username" placeholder="Your name" class="border p-2 mr-2">
                <textarea name="message" placeholder="Your message" class="border p-2 mr-2"></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Post Message
                </button>
            </form>

            <!-- Messages will be displayed here -->
            <?php
            // Fetch messages from the database

            foreach ($messages as $message) {
                echo "<div class='bg-white p-4 rounded shadow mb-4'>";
                echo "<h2 class='font-bold'>" . htmlspecialchars($message['username']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($message['message'])) . "</p>";
                echo "<small>Posted on " . $message['created_at'] . "</small>";
                echo "</div>";
            }
            ?>

        <?php else: ?>
            <h1 class="text-2xl font-bold mb-6">Login to Message Board</h1>
            <?php if (isset($error)): ?>
                <p class="text-red-500">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" class="border p-2 mr-2" required>
                <input type="password" name="password" placeholder="Password" class="border p-2 mr-2" required>
                <button type="submit" name="login"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>