<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Assignment | Student</title>
    <link rel="stylesheet" href="../css/submit_assignment.css">
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
        <div class="upload-box">
            <h1>Submit Assignment</h1>
            <p>Upload your assignment for review</p>

            <?php
            if (isset($_GET['success'])) {
                echo "<div class='message success'>Assignment submitted successfully!</div>";
            }
            if (isset($_GET['error'])) {
                echo "<div class='message error'>Error submitting assignment. Please try again.</div>";
            }
            ?>

            <form action="../php/submit_assignment.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Assignment Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter assignment title" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Describe your assignment" required></textarea>
                </div>

                <div class="form-group">
                    <label for="file">Select PDF File</label>
                    <input type="file" name="file" id="file" accept=".pdf" required>
                </div>

                <button type="submit" name="submit" class="btn-submit">Submit Assignment</button>
            </form>
        </div>
    </div>
</body>
</html>