<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password
    
    // Prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    try {
        $stmt->execute();
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registration Successful</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div class="container success">
                <h2>🎉 Registration Successful! 🎉</h2>
                <p>Your account has been created successfully.</p>
                <a href="index.html" class="home-btn">Go to Login</a>
            </div>
        </body>
        </html>';
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registration Error</title>
                <link rel="stylesheet" type="text/css" href="style.css">
            </head>
            <body>
                <div class="container error">
                    <h2>❌ Username Already Exists ❌</h2>
                    <p>The username "<strong>' . htmlspecialchars($username) . '</strong>" is already taken. Please choose a different one.</p>
                    <a href="register.html" class="home-btn">Try Again</a>
                </div>
            </body>
            </html>';
        } else {
            echo "Error: " . $e->getMessage();
        }
    }

    $stmt->close();
    $conn->close();
}
?>
