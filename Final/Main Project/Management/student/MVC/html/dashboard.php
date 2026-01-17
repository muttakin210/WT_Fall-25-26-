<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.php");
    exit();
}

// Get user's full name from session
$full_name = $_SESSION['full_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard | AIUB Notes</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

    <div class="navbar">
        <h2>AIUB Notes</h2>
        <a href="../php/logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($full_name); ?></h1>
        <p>Select what you want to access</p>

        <div class="cards">
            <div class="card">
                <h3>Course Notes</h3>
                <p>View and download notes.</p>
                <a href="#">Open</a>
            </div>

            <div class="card">
                <h3>Slides</h3>
                <p>Access lecture slides.</p>
                <a href="#">Open</a>
            </div>

            <div class="card">
                <h3>Upload</h3>
                <p>Share your notes with others.</p>
                <a href="#">Upload</a>
            </div>
        </div>
    </div>

</body>
</html>
