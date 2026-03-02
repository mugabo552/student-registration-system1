<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Only admin can delete users
if ($_SESSION['role'] != 'admin') {
    header('Location: dashboard.php');
    exit();
}

require_once 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Prevent deleting own account
    if ($id == $_SESSION['user_id']) {
        header('Location: view_users.php?error=Cannot delete your own account');
        exit();
    }
    
    $query = "DELETE FROM users WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: view_users.php?success=User deleted successfully');
    } else {
        header('Location: view_users.php?error=Failed to delete user');
    }
} else {
    header('Location: view_users.php');
}
exit();
?>
