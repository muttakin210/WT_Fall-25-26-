<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['full_name'];

// Get search query if exists
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';


if ($search) {
    $sql = "SELECT m.*, a.full_name as admin_name FROM materials m 
            LEFT JOIN admins a ON m.admin_id = a.id 
            WHERE (m.title LIKE '%$search%' OR m.description LIKE '%$search%') 
            ORDER BY m.uploaded_at DESC";
} else {
    $sql = "SELECT m.*, a.full_name as admin_name FROM materials m 
            LEFT JOIN admins a ON m.admin_id = a.id 
            ORDER BY m.uploaded_at DESC";
}

// Fallback for old database structure
$result = mysqli_query($conn, $sql);
if (!$result) {
    
    if ($search) {
        $sql = "SELECT m.*, t.full_name as admin_name FROM materials m 
                LEFT JOIN teachers t ON m.teacher_id = t.id 
                WHERE (m.title LIKE '%$search%' OR m.description LIKE '%$search%') 
                ORDER BY m.uploaded_at DESC";
    } else {
        $sql = "SELECT m.*, t.full_name as admin_name FROM materials m 
                LEFT JOIN teachers t ON m.teacher_id = t.id 
                ORDER BY m.uploaded_at DESC";
    }
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Course Notes | Student</title>
    <link rel="stylesheet" href="../css/search_notes.css">
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
        <h1>Find Your Course Notes</h1>
        <p>Search and download course materials uploaded by your instructors</p>

        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search notes by title, description, or course..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
                <?php if ($search): ?>
                    <a href="search_notes.php" class="clear-search">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Notes Grid -->
        <div class="notes-grid">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="note-card">
                        <div class="note-header">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <span class="upload-date"><?php echo date('M j, Y', strtotime($row['uploaded_at'])); ?></span>
                        </div>
                        <div class="note-content">
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="file-info">
                                <span class="file-name"> <?php echo htmlspecialchars($row['file_name']); ?></span>
                                <span class="instructor"> <?php echo htmlspecialchars($row['admin_name'] ?? 'Unknown'); ?></span>
                            </div>
                        </div>
                        <div class="note-actions">
                            <a href="../php/download_student_pdf.php?id=<?php echo $row['id']; ?>" class="btn-download"> Download</a>
                            <a href="../php/view_student_pdf.php?id=<?php echo $row['id']; ?>" class="btn-view" target="_blank"> View</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-notes">
                    <h3> No notes found</h3
                    <p><?php echo $search ? "No notes match your search criteria. Try different keywords." : "No course materials have been uploaded yet."; ?></p>
                    <?php if ($search): ?>
                        <a href="search_notes.php" class="btn-clear">Show All Notes</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>