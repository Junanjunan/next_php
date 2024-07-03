<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow CORS
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $response = [
        'success' => true,
        'message' => 'POST request received successfully!!',
        'data' => [
            'param1' => $input['param1'] ?? 'No param1 provided',
            'param2' => $input['param2'] ?? 'No param2 provided'
        ]
    ];

    echo json_encode($response);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>