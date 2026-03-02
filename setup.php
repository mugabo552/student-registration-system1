<?php
// Setup script - Run this once to create admin user
require_once 'config.php';

// Create admin user with properly hashed password
$admin_username = 'admin';
$admin_email = 'admin@school.com';
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);

// Create teacher user with properly hashed password
$teacher_username = 'teacher';
$teacher_email = 'teacher@school.com';
$teacher_password = password_hash('teacher123', PASSWORD_DEFAULT);

// Check if admin exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE username='admin'");

if (mysqli_num_rows($check) > 0) {
    // Update existing admin
    $query = "UPDATE users SET password='$admin_password' WHERE username='admin'";
    mysqli_query($conn, $query);
    echo "Admin password updated successfully!<br>";
} else {
    // Insert new admin
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$admin_username', '$admin_email', '$admin_password', 'admin')";
    mysqli_query($conn, $query);
    echo "Admin user created successfully!<br>";
}

// Check if teacher exists
$check_teacher = mysqli_query($conn, "SELECT * FROM users WHERE username='teacher'");

if (mysqli_num_rows($check_teacher) > 0) {
    // Update existing teacher
    $query = "UPDATE users SET password='$teacher_password' WHERE username='teacher'";
    mysqli_query($conn, $query);
    echo "Teacher password updated successfully!<br>";
} else {
    // Insert new teacher
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$teacher_username', '$teacher_email', '$teacher_password', 'teacher')";
    mysqli_query($conn, $query);
    echo "Teacher user created successfully!<br>";
}

echo "<br>Login credentials:<br>";
echo "<strong>Admin:</strong><br>";
echo "Username: admin<br>";
echo "Password: admin123<br><br>";
echo "<strong>Teacher:</strong><br>";
echo "Username: teacher<br>";
echo "Password: teacher123<br>";
echo "<br><a href='login.php'>Go to Login</a>";
echo "<br><br>";
echo "<strong>Note:</strong> New users can now register at <a href='register.php'>register.php</a>";
?>