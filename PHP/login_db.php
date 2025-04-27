<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internmatch");

if ($conn->connect_error) {
    header("Location: ../HTML/login.html?status=db_error");
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_type'] = $user['role'];

        echo "<script>
                alert('Login Success!');
                window.location.href = '../HTML/userprofile.html';
              </script>";
        exit;
    } else {
        header("Location: ../HTML/login.html?status=incorrect_password");
        exit;
    }
} else {
    header("Location: ../HTML/login.html?status=user_not_found");
    exit;
}

$stmt->close();
$conn->close();
?>
