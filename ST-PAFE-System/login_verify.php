<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once 'connection.php';
header('Content-Type: application/json');

if ($con->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $con->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'No data received']);
        exit;
    }

    $userId = trim($data['userId']);
    $password = trim($data['password']);

    $stmt = $con->prepare("SELECT * FROM pafe_acc WHERE id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['password'];

        // Check if the stored password is hashed (starts with $2y$ for bcrypt)
        if (
            (strlen($storedPassword) === 60 && strpos($storedPassword, '$2y$') === 0) &&
            password_verify($password, $storedPassword)
        ) {
            // Hashed password and verified
            loginSuccess($user);
        } elseif ($password === $storedPassword) {
            // Plain-text password match
            // Migrate to hashed password
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $update = $con->prepare("UPDATE pafe_acc SET password = ? WHERE id = ?");
            $update->bind_param("ss", $newHash, $userId);
            $update->execute();
            $update->close();

            loginSuccess($user);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$con->close();

function loginSuccess($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['lastname'] = $user['lastname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['logged_in'] = true;

    // Fixed: Capitalize role for frontend routing to match index.php expectations
    $roleForRouting = ucfirst(strtolower($user['role'])); // 'officer' -> 'Officer'

    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'role' => $roleForRouting
    ]);
}
?>
