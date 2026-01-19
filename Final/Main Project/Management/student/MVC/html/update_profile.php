<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch student info
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile | Student</title>
    <link rel="stylesheet" href="../css/update_profile.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Student</h2>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="profile-box">
            <h1>Update Profile</h1>
            <p>Update your personal information</p>

            <!-- Show success/error messages -->
            <?php
            if (isset($_GET['success'])) {
                echo "<div class='message success'>Profile updated successfully!</div>";
            }
            if (isset($_GET['error'])) {
                echo "<div class='message error'>Error updating profile. Please try again.</div>";
            }
            ?>

            <form action="../php/update_profile.php" method="POST">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password (Leave blank to keep current)</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter new password (optional)">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn-update">Update Profile</button>
                    <a href="dashboard.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>