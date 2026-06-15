<?php
declare(strict_types=1);

// upload.php - Einfache Datei-Upload-Handler für AJAX-Anfragen
// The response is always JSON, so we set the header accordingly
header('Content-Type: application/json; charset=utf-8');

$uploadDir = __DIR__ . '/uploads/';
// Initialize the response array with a default failure state
$response  = ['success' => false];

// Check if a file was uploaded and if there were no errors
// during the upload process
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
	http_response_code(400);  // Bad Request
	$response['message'] = 'Keine gültige Datei empfangen.';
	// Encode the response as JSON and send it back to the client
	echo json_encode($response); 
	exit;
}

// Ensure the upload directory exists and is writable
// if it doesn't exist, attempt to create it. 
// If creation fails, return an error response.
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
	http_response_code(500); // Internal Server Error
	$response['message'] = 'Upload-Verzeichnis nicht verfügbar.';
	echo json_encode($response);
	exit;
}

// Process the uploaded file
$file      = $_FILES['file'];
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
// Generate a unique filename to prevent overwriting existing files
$filename  = sprintf(
	'%s.%s',
	bin2hex(random_bytes(16)),
	$extension
);

$targetPath = $uploadDir . $filename;

if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
	http_response_code(500);
	$response['message'] = 'Fehler beim Speichern der Datei.';
	echo json_encode($response);
	exit;
}

$response['success']  = true;
$response['message']  = 'Upload erfolgreich.';
$response['filename'] = $filename;

echo json_encode($response);
?>