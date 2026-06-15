<?php
header('Content-Type: application/json');

$dir = __DIR__ . '/uploads/';
$extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

$files = array_filter(scandir($dir), function($file) use ($dir, $extensions) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return is_file($dir . $file) && in_array($ext, $extensions);
});

echo json_encode(array_values($files));
?>