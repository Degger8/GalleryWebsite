<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$filename = basename($data['filename'] ?? '');
$path = __DIR__ . '/uploads/' . $filename;

if ($filename && file_exists($path)) {
    unlink($path);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'File not found.']);
}
?>