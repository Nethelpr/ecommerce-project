<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

// Adjust path depending on where this lives relative to your includes folder:
require_once __DIR__ . '/../includes/db.php'; // or 'includes/db.php' if in root

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['pass'] ?? '';

if (!$email || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Valid email and password are required.']);
    exit;
}

try {
    // adjust column name: if your table stores email, use email; if it stores username, rename variable to $username.
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :email LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        // regenerate session ID for security
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials.']);
    }
} catch (PDOException $e) {
    // log $e->getMessage() to server logs instead of exposing full error in production
    echo json_encode(['status' => 'error', 'message' => 'Database error.']);
}
