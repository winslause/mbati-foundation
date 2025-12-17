<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}


try {
    // Validate required fields
    $required_fields = ['name', 'email', 'message'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            echo json_encode(['success' => false, 'error' => ucfirst($field) . ' is required']);
            exit;
        }
    }

    // Validate email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Invalid email address']);
        exit;
    }

    // Insert contact message
    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, subject, message, is_read) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        trim($_POST['name']),
        trim($_POST['email']),
        isset($_POST['phone']) ? trim($_POST['phone']) : null,
        isset($_POST['subject']) ? trim($_POST['subject']) : null,
        trim($_POST['message']),
        false
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Your message has been sent successfully! We will get back to you within 24 hours.',
        'id' => $pdo->lastInsertId()
    ]);

} catch (PDOException $e) {
    error_log('Contact form error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error occurred. Please try again.']);
} catch (Exception $e) {
    error_log('Contact form error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'An error occurred. Please try again.']);
}
?>