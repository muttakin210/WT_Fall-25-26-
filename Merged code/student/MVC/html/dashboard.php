<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes</h2>
        <a href="../php/logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['full_name']; ?></h1>
        <div class="cards">
            <a href="search_notes.php" class="card">Search Notes</a>
            <a href="update_profile.php" class="card">Update Profile</a>
        </div>
    </div>
</body>
</html>