<?php
header('Content-Type: application/json');

// Database connection configuration
$db_host = 'srv1140.hstgr.io';
$db_user = 'u854855859_upgw';
$db_password = 'KH9pl$Tx3*M';
$db_name = 'u854855859_upgw';
$db_port = 3306;

// Create a new database connection
$connection = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

// Check for a connection error
if ($connection->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $connection->connect_error]);
    exit();
}

// Determine the request method
$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method === 'GET') {
    // Handle GET request to retrieve data
    handle_get_request($connection);
} elseif ($request_method === 'POST') {
    // Handle POST request to update data
    handle_post_request($connection);
} else {
    // Unsupported request method
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

// Close the database connection
$connection->close();

/**
 * Handle the GET request to retrieve data from the database
 */
function handle_get_request($connection) {
    $query = "SELECT id, code FROM upgw WHERE status='0' ORDER BY RAND() LIMIT 1";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => '0'
        ]);
    } else {
        // No data found
        http_response_code(404);
        echo json_encode(['error' => 'No data found']);
    }
}

/**
 * Handle the POST request to update data in the database
 */
function handle_post_request($connection) {
    // Read the raw POST data
    $post_data = json_decode(file_get_contents('php://input'), true);

    // Validate the received data
    if (!isset($post_data['id']) || !isset($post_data['result']) || !isset($post_data['status'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        return;
    }

    $id = $connection->real_escape_string($post_data['id']);
    $result = $connection->real_escape_string($post_data['result']);
    $status = $connection->real_escape_string($post_data['status']);

    // Update the database with the result
    $query = "UPDATE upgw SET status = '$status', result = '$result' WHERE id = '$id'";
    if ($connection->query($query) === TRUE) {
        echo json_encode(['message' => 'Update successful']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update the database: ' . $connection->error]);
    }
}
