<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Only admin can access this page
if ($_SESSION['role'] != 'admin') {
    header('Location: dashboard.php');
    exit();
}

require_once 'config.php';

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - School Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h3>Dashboard</h3>
            <ul>
                <li><a href="dashboard.php">Overview</a></li>
                <li><a href="#" onclick="return false;">Add User</a></li>
                <li><a href="#" onclick="openModal('studentModal')">Add Student</a></li>
                <li><a href="view_users.php" class="active">Manage Users</a></li>
                <li><a href="view_students.php">Manage Students</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1 style="margin-bottom: 2rem; font-weight: 700; font-size: 2rem; color: #000;">User Management</h1>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
            <?php endif; ?>
            
            <div class="table-container">
                <h2>All System Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo ucfirst($user['role']); ?></td>
                            <td>
                                <button class="btn btn-small btn-success" onclick="editUser(<?php echo $user['id']; ?>, '<?php echo $user['email']; ?>', '<?php echo $user['username']; ?>')">Update</button>
                                <button class="btn btn-small btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="view_students.php">Students</a></li>
                    <li><a href="view_users.php">Users</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>About</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <ul>
                    <li>Kigali, Rwanda</li>
                    <li>KK720 St</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 School Management System. Developed by Mugabo Joseph. All rights reserved.</p>
        </div>
    </footer>

    <!-- Edit User Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update User</h2>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
            </div>
            <form method="POST" action="update_user.php">
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="edit_email" required placeholder="user@example.com">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="edit_username" required placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current password">
                </div>
                <button type="submit" class="btn">Update User</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function editUser(id, email, username) {
            document.getElementById('edit_user_id').value = id;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_username').value = username;
            openModal('editModal');
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = 'delete_user.php?id=' + id;
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>