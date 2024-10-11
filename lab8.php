<?php
// Define the target directory for uploads
$targetDir = __DIR__ . '/temp_jhsrfbh57tt/';

// Check if the 'temp_jhsrfbh57tt' directory exists, create it if not
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if a file has been uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Get the original filename
    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;

    // Check for upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo json_encode([
                'success' => true,
                'message' => 'File uploaded successfully.',
                'file' => $fileName
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to move uploaded file.'
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Error during file upload.',
            'error_code' => $file['error']
        ]);
    }
} else {
    // No file was uploaded
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'No file uploaded.'
    ]);
}
?>
