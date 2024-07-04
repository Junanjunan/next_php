<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['mb_id'])) {
    // User is not logged in, redirect to login page
    echo json_encode([
        'success' => false,
        'message' => 'There is no mb_id in session',
    ]);
    return;
}

// Get the mb_id from the URL
$mb_id = $_GET['mb_id'];

// Check if the logged-in user matches the requested profile
if ($_SESSION['mb_id'] !== $mb_id) {
    echo json_encode([
        'success' => false,
        'message' => "Access denied. You can only view your own profile.",
    ]);
    return;
}

echo json_encode([
    'success' => true,
    'mb_id' => $_SESSION['mb_id'],
    'cookie' => $_COOKIE['PHPSESSID'] ?? 'No cookie',
]);
?>
