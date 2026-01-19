<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

$admin_name = $_SESSION['full_name'];

// Get filter status if exists
$status_filter = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';

// Build query based on filter
if ($status_filter && $status_filter != 'all') {
    $sql = "SELECT s.*, st.full_name as student_name, st.email as student_email 
            FROM student_submissions s 
            JOIN students st ON s.student_id = st.id 
            WHERE s.status = '$status_filter' 
            ORDER BY s.submitted_at DESC";
} else {
    $sql = "SELECT s.*, st.full_name as student_name, st.email as student_email 
            FROM student_submissions s 
            JOIN students st ON s.student_id = st.id 
            ORDER BY s.submitted_at DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review Submissions | Admin</title>
    <link rel="stylesheet" href="../css/review_submissions.css">
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
        <h1>Review Student Submissions</h1>
        <p>Review and approve student uploaded materials</p>

        <!-- Filter Box -->
        <div class="filter-box">
            <form method="GET" action="">
                <label for="status">Filter by Status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="all" <?php echo ($status_filter == 'all' || $status_filter == '') ? 'selected' : ''; ?>>All Submissions</option>
                    <option value="pending" <?php echo $status_filter == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="approved" <?php echo $status_filter == 'approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="rejected" <?php echo $status_filter == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </form>
        </div>

        <!-- Submissions Grid -->
        <div class="submissions-grid">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="submission-card">
                        <div class="submission-header">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <span class="status status-<?php echo $row['status']; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </div>
                        
                        <div class="submission-info">
                            <p><strong>Student:</strong> <?php echo htmlspecialchars($row['student_name']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['student_email']); ?></p>
                            <p><strong>Submitted:</strong> <?php echo date('M j, Y g:i A', strtotime($row['submitted_at'])); ?></p>
                        </div>

                        <div class="submission-content">
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="file-info">
                                <span class="file-name">📄 <?php echo htmlspecialchars($row['file_name']); ?></span>
                            </div>
                        </div>

                        <?php if ($row['admin_comment']): ?>
                            <div class="admin-comment">
                                <strong>Admin Comment:</strong>
                                <p><?php echo htmlspecialchars($row['admin_comment']); ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="submission-actions">
                            <a href="../php/view_submission.php?id=<?php echo $row['id']; ?>" class="btn-view" target="_blank">View File</a>
                            <a href="../php/download_submission.php?id=<?php echo $row['id']; ?>" class="btn-download">Download</a>
                            
                            <?php if ($row['status'] == 'pending'): ?>
                                <button onclick="showReviewModal(<?php echo $row['id']; ?>, 'approve')" class="btn-approve">Approve</button>
                                <button onclick="showReviewModal(<?php echo $row['id']; ?>, 'reject')" class="btn-reject">Reject</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-submissions">
                    <h3>📋 No submissions found</h3>
                    <p><?php echo $status_filter ? "No submissions with status '$status_filter'." : "No student submissions yet."; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Review Submission</h2>
            <form id="reviewForm" action="../php/review_submission.php" method="POST">
                <input type="hidden" id="submissionId" name="submission_id">
                <input type="hidden" id="reviewAction" name="action">
                
                <div class="form-group">
                    <label for="comment">Comment (Optional):</label>
                    <textarea id="comment" name="comment" rows="4" placeholder="Add your review comment..."></textarea>
                </div>
                
                <div class="modal-actions">
                    <button type="submit" id="submitBtn" class="btn-submit">Submit Review</button>
                    <button type="button" onclick="closeModal()" class="btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showReviewModal(submissionId, action) {
            document.getElementById('submissionId').value = submissionId;
            document.getElementById('reviewAction').value = action;
            document.getElementById('modalTitle').textContent = action === 'approve' ? 'Approve Submission' : 'Reject Submission';
            document.getElementById('submitBtn').textContent = action === 'approve' ? 'Approve' : 'Reject';
            document.getElementById('submitBtn').className = action === 'approve' ? 'btn-submit btn-approve' : 'btn-submit btn-reject';
            document.getElementById('reviewModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('reviewModal').style.display = 'none';
            document.getElementById('comment').value = '';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('reviewModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>