<?php
session_start();

// Check if teacher is logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'teacher') {
    header("Location: ../../../Teacher/MVC/html/teacher_login.php");
    exit();
}

$teacher_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard | AIUB Notes</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

    <div class="navbar">
        <h2>AIUB Notes – Teacher</h2>
        <a href="../php/logout.php">Logout</a>
    </div>

    <div class="container">
        <!-- Display logged-in teacher's name -->
        <h1>Welcome, MR. <?php echo htmlspecialchars($teacher_name); ?></h1>
        <p>Manage your courses and materials</p>

        <div class="cards">
            <div class="card">
                <h3>My Courses</h3>
                <p>View and manage assigned courses.</p>
                <a href="#">Open</a>
            </div>

            <div class="card">
                <h3>Upload Materials</h3>
                <p>Upload notes and lecture slides.</p>
                <a href="#">Upload</a>
            </div>

            <div class="card">
                <h3>Review Submissions</h3>
                <p>Check student-uploaded notes.</p>
                <a href="#">Review</a>
            </div>

            <div class="card">
                <h3>Profile</h3>
                <p>Update your profile information.</p>
                <a href="#">Edit</a>
            </div>
        </div>
    </div>

</body>
</html>
