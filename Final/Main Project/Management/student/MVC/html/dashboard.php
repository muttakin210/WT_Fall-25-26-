<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.php");
    exit();
}


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
                <h3>Find Your Course Notes</h3>
                <p>Search and download course materials.</p>
                <a href="search_notes.php">Search Notes</a>
            </div>

            <div class="card">
                <h3>Slides</h3>
                <p>Access lecture slides.</p>
                <a href="#">Open</a>
            </div>

            <div class="card">
                <h3>Submit Assignment</h3>
                <p>Upload your assignments for review.</p>
                <a href="submit_assignment.php">Submit</a>
            </div>

            <div class="card">
                <h3>Profile</h3>
                <p>Update your profile information.</p>
                <a href="update_profile.php">Edit Profile</a>
            </div>
        </div>
    </div>

</body>
</html>
