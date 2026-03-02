<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "DELETE FROM students WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: view_students.php?success=Student deleted successfully');
    } else {
        header('Location: view_students.php?error=Failed to delete student');
    }
} else {
    header('Location: view_students.php');
}
exit();
?>
