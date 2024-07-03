<?php
$servername = "localhost";
$username = "gnutest";
$password = "86357811";
$dbname = "php_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mb_id = $_POST['mb_id'];
    $mb_password_plain = $_POST['mb_password'];
    $mb_password_hashed = password_hash($mb_password_plain, PASSWORD_BCRYPT);  // password_hash 사용

    $stmt = $conn->prepare("INSERT INTO users (mb_id, mb_password) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $mb_id, $mb_password_hashed);
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
}

$conn->close();
?>