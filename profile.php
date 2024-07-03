<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['mb_id'])) {
    // User is not logged in, redirect to login page
    header("Location: /login");
    exit;
}

// Get the mb_id from the URL
$mb_id = $_GET['mb_id'];

// Check if the logged-in user matches the requested profile
if ($_SESSION['mb_id'] !== $mb_id) {
    echo "Access denied. You can only view your own profile.";
    exit;
}

// User is logged in and the profile matches, display the profile page content
echo "Welcome to your profile page, " . htmlspecialchars($mb_id) . "!";
?>
