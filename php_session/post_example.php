<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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