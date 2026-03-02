<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    
    $query = "UPDATE students SET student_id='$student_id', name='$name', email='$email', phone='$phone', course='$course' WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: view_students.php?success=Student updated successfully');
    } else {
        header('Location: view_students.php?error=Failed to update student');
    }
    exit();
}
?>
