<?php
header('Content-Type: application/json');
require_once 'conn.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $response = [
            'success' => true,
            'data' => [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'middle_name' => $user['middle_name'] ?? null,
                'last_name' => $user['last_name'],
                'full_name' => trim($user['first_name'] . ' ' . $user['last_name']),
                'email' => $user['email'],
                'phone' => $user['phone'] ?? null,
                'dob' => $user['dob'] ?? null,
                'gender' => $user['gender'] ?? null,
                'bio' => $user['bio'] ?? null,
                'profile_photo' => !empty($user['profile_photo']) ? 'uploads/' . $user['profile_photo'] : null,
                'role' => $user['role'] ?? null
            ]
        ];
    } else {
        $response = ['success' => false, 'message' => 'User not found'];
    }
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
}

echo json_encode($response);
exit;
