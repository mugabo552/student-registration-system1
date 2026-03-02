<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Only admin can add users
if ($_SESSION['role'] != 'admin') {
    header('Location: dashboard.php');
    exit();
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
    
    if (mysqli_query($conn, $query)) {
        header('Location: view_users.php?success=User added successfully');
    } else {
        header('Location: dashboard.php?error=Failed to add user');
    }
    exit();
}
?>
