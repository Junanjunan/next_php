<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$username = "gnutest";
$password = "86357811";
$dbname = "php_db";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $mb_id = $input['mb_id'];
    $mb_password = $input['password'];
    $response = [
        'success' => true,
        'message' => 'POST request received successfully!!',
        'data' => [
            'mb_id' => $mb_id ?? 'No mb_id provided',
            'mb_password' => $mb_password ?? 'No password provided',
            'session_id' => session_id()
        ]
    ];


    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT mb_password FROM users WHERE mb_id = ?");

    if ($stmt) {
        $stmt->bind_param("s", $mb_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($mb_password_hashed);
        $stmt->fetch();

        if ($stmt->num_rows > 0) {

            if (password_verify($mb_password, $mb_password_hashed)) {
                $_SESSION['mb_id'] = $mb_id;
                $session_id = session_id();
                echo $session_id;
                echo json_encode([
                    'success' => true,
                    'message' => "Login successful",
                    "session" => $session_id
                ]);
                // Redirect to a protected page
                // header("Location: protected_page.php");
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Invalid password."
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Invalid username."
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Failed to prepare the SQL statement."
        ]);
    }

    echo json_encode($response);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>