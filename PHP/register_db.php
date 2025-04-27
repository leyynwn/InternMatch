<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internmatch");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$role = $_POST['user_type'];

// Check if passwords match
if ($password !== $confirm) {
    header("Location: ../HTML/login.html?status=password_mismatch");
    exit();
}

// Hash password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email exists
$sql_check_email = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    // Email exists, show alert
    echo "<script>alert('Email already exists!'); window.location.href = '../HTML/login.html';</script>";
    exit();
}

// Insert into DB
$sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$hashed_password', '$role')";
if ($conn->query($sql) === TRUE) {
    $user_id = $conn->insert_id;
    $sql_profile = "INSERT INTO profile_data (user_id, full_name, email) VALUES ('$user_id', '$full_name', '$email')";
    if ($conn->query($sql_profile) === TRUE) {
        echo "<script>alert('Registration complete!'); window.location.href = '../HTML/search_page.html';</script>";
    } else {
        echo "<script>alert('Failed to create profile!'); window.location.href = '../HTML/login.html';</script>";
    }
} else {
    echo "<script>alert('Registration failed. Please try again!'); window.location.href = '../HTML/login.html';</script>";
}

$conn->close();
?>
