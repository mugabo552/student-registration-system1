<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

$students = mysqli_query($conn, "SELECT * FROM students ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - School Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h3>Dashboard</h3>
            <ul>
                <li><a href="dashboard.php">Overview</a></li>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <li><a href="#" onclick="return false;">Add User</a></li>
                <?php endif; ?>
                <li><a href="#" onclick="openModal('studentModal')">Add Student</a></li>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                <li><a href="view_users.php">Manage Users</a></li>
                <?php endif; ?>
                <li><a href="view_students.php" class="active">Manage Students</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1 style="margin-bottom: 2rem; font-weight: 700; font-size: 2rem; color: #000;">Student Management</h1>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
            <?php endif; ?>
            
            <div class="table-container">
                <h2>All Enrolled Students</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($student = mysqli_fetch_assoc($students)): ?>
                        <tr>
                            <td><?php echo $student['student_id']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['email']; ?></td>
                            <td><?php echo $student['phone']; ?></td>
                            <td><?php echo $student['course']; ?></td>
                            <td>
                                <button class="btn btn-small btn-success" onclick='editStudent(<?php echo json_encode($student); ?>)'>Update</button>
                                <button class="btn btn-small btn-danger" onclick="deleteStudent(<?php echo $student['id']; ?>)">Delete</button>
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

    <!-- Add Student Modal -->
    <div id="studentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Student</h2>
                <span class="close" onclick="closeModal('studentModal')">&times;</span>
            </div>
            <form method="POST" action="add_student.php">
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" required placeholder="e.g., STD001">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required placeholder="Enter student name">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="student@example.com">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="078XXXXXXX">
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <input type="text" name="course" required placeholder="e.g., Computer Science">
                </div>
                <button type="submit" class="btn">Add Student</button>
            </form>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Student</h2>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
            </div>
            <form method="POST" action="update_student.php">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" id="edit_student_id" required placeholder="e.g., STD001">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="edit_name" required placeholder="Enter student name">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="edit_email" required placeholder="student@example.com">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" id="edit_phone" placeholder="078XXXXXXX">
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <input type="text" name="course" id="edit_course" required placeholder="e.g., Computer Science">
                </div>
                <button type="submit" class="btn">Update Student</button>
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

        function editStudent(student) {
            document.getElementById('edit_id').value = student.id;
            document.getElementById('edit_student_id').value = student.student_id;
            document.getElementById('edit_name').value = student.name;
            document.getElementById('edit_email').value = student.email;
            document.getElementById('edit_phone').value = student.phone;
            document.getElementById('edit_course').value = student.course;
            openModal('editModal');
        }

        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                window.location.href = 'delete_student.php?id=' + id;
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