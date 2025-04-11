<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internmatch", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];

// Get user from DB
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Save session and redirect
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role']; 
        header("Location: ../index.php");
        exit;
    } else {
        echo "Incorrect password!";
    }
} else {
    echo "No user found!";
}

$stmt->close();
$conn->close();
?>
