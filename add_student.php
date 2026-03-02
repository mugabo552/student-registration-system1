<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    
    $query = "INSERT INTO students (student_id, name, email, phone, course) VALUES ('$student_id', '$name', '$email', '$phone', '$course')";
    
    if (mysqli_query($conn, $query)) {
        header('Location: view_students.php?success=Student added successfully');
    } else {
        header('Location: dashboard.php?error=Failed to add student');
    }
    exit();
}
?>
