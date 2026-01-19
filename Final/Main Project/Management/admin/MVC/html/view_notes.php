<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['full_name'];

// Get search query if exists
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Build query based on search
if ($search) {
    $sql = "SELECT * FROM materials WHERE admin_id = '$admin_id' AND (title LIKE '%$search%' OR description LIKE '%$search%') ORDER BY uploaded_at DESC";
} else {
    $sql = "SELECT * FROM materials WHERE admin_id = '$admin_id' ORDER BY uploaded_at DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Uploaded Notes | Admin</title>
    <link rel="stylesheet" href="../css/view_notes.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Admin</h2>
        <div class="nav-links">
            <a href="Dashboard.php">Dashboard</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>My Uploaded Notes</h1>
        <p>Manage and view your uploaded course materials</p>

        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search notes by title or description..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
                <?php if ($search): ?>
                    <a href="view_notes.php" class="clear-search">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Notes Grid -->
        <div class="notes-grid">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="note-card">
                        <div class="note-header">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <span class="upload-date"><?php echo date('M j, Y', strtotime($row['uploaded_at'])); ?></span>
                        </div>
                        <div class="note-content">
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="file-info">
                                <span class="file-name">📄 <?php echo htmlspecialchars($row['file_name']); ?></span>
                                <span class="file-type"><?php echo strtoupper($row['file_type']); ?></span>
                            </div>
                        </div>
                        <div class="note-actions">
                            <a href="../php/download_pdf.php?id=<?php echo $row['id']; ?>" class="btn-download">Download</a>
                            <a href="../php/view_pdf.php?id=<?php echo $row['id']; ?>" class="btn-view" target="_blank">View</a>
                            <a href="../php/delete_note.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            
        </div>
    </div>
</body>
</html>