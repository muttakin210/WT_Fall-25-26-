<?php
session_start();

// Include auto-login check
include "../../../student/MVC/php/check_auto_login.php";

// Check if user is logged in or can be auto-logged in
if (!checkAutoLogin() || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id']; 
$admin_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | AIUB Notes</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Admin</h2>
        <a href="../php/logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($admin_name); ?></h1>
        <p>Manage courses and materials</p>

        <div class="cards">
            <div class="card">
                <h3>Courses</h3>
                <p>View and manage assigned courses.</p>
                <a href="#">Open</a>
            </div>

            <div class="card">
                <h3>Upload Materials</h3>
                <p>Upload notes and lecture slides.</p>
                <a href="upload_materials.php">Upload</a>
            </div>

            <div class="card">
                <h3>Find Your Course Notes</h3>
                <p>View and manage uploaded materials.</p>
                <a href="view_notes.php">View Notes</a>
            </div>

            <div class="card">
                <h3>Review Submissions</h3>
                <p>Check student-uploaded assignments.</p>
                <a href="review_submissions.php">Review</a>
            </div>

            <div class="card">
                <h3>Profile</h3>
                <p>Update your profile information.</p>
                <a href="updateprofile.php">Edit</a>
            </div>
        </div>
    </div>
</body>
</html>
