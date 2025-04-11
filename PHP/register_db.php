<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "internmatch");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$role = $_POST['user_type'];

// Check if passwords match
if ($password !== $confirm) {
    echo "Passwords do not match!";
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert to DB
$sql = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $hashed_password, $role);

if ($stmt->execute()) {
    header("Location: ../index.php");
    exit();
} else {
    echo "Registration failed: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
