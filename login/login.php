<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

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

    echo "Received username: $mb_id<br>";
    echo "Received password: $mb_password_plain<br>";

    $stmt = $conn->prepare("SELECT mb_password FROM users WHERE mb_id = ?");
    if ($stmt) {
        echo "Statement prepared successfully.<br>";

        $stmt->bind_param("s", $mb_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($mb_password_hashed);
        $stmt->fetch();

        echo "Number of rows: " . $stmt->num_rows . "<br>";

        if ($stmt->num_rows > 0) {
            echo "User found. Checking password...<br>";
            echo "Stored hashed password: $mb_password_hashed<br>";

            if (password_verify($mb_password_plain, $mb_password_hashed)) {
                $_SESSION['mb_id'] = $mb_id;
                echo "Login successful";
                // Redirect to a protected page
                // header("Location: protected_page.php");
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
}

$conn->close();
?>