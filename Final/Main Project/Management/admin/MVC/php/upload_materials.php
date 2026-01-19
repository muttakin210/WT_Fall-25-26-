<?php
session_start();
include "../db/db.php";

/* Check admin login */
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

if (isset($_POST['upload'])) {

    $admin_id = $_SESSION['admin_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmp  = $_FILES['file']['tmp_name'];

    /* Allow only PDF */
    if ($fileType != "application/pdf") {
        echo "<script>alert('Only PDF files are allowed');</script>";
        echo "<script>window.location.href='../html/upload_materials.php';</script>";
        exit();
    }

    /* Read file data */
    $fileData = addslashes(file_get_contents($fileTmp));

    // Check which column exists in materials table
    $check_admin_column = "SHOW COLUMNS FROM materials LIKE 'admin_id'";
    $admin_result = mysqli_query($conn, $check_admin_column);
    
    $check_teacher_column = "SHOW COLUMNS FROM materials LIKE 'teacher_id'";
    $teacher_result = mysqli_query($conn, $check_teacher_column);
    
    if (mysqli_num_rows($admin_result) > 0) {
        // Use admin_id column
        $sql = "INSERT INTO materials 
                (admin_id, title, description, file_name, file_type, file_data)
                VALUES 
                ('$admin_id', '$title', '$description', '$fileName', '$fileType', '$fileData')";
    } elseif (mysqli_num_rows($teacher_result) > 0) {
        // Use teacher_id column (fallback for existing database)
        $sql = "INSERT INTO materials 
                (teacher_id, title, description, file_name, file_type, file_data)
                VALUES 
                ('$admin_id', '$title', '$description', '$fileName', '$fileType', '$fileData')";
    } else {
        // Neither column exists - create the table
        $create_table = "CREATE TABLE materials (
            id INT AUTO_INCREMENT PRIMARY KEY,
            admin_id INT NOT NULL,
            title VARCHAR(200) NOT NULL,
            description TEXT,
            file_name VARCHAR(255) NOT NULL,
            file_type VARCHAR(50) NOT NULL,
            file_data LONGBLOB NOT NULL,
            uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (mysqli_query($conn, $create_table)) {
            $sql = "INSERT INTO materials 
                    (admin_id, title, description, file_name, file_type, file_data)
                    VALUES 
                    ('$admin_id', '$title', '$description', '$fileName', '$fileType', '$fileData')";
        } else {
            echo "<script>alert('Database error: Could not create materials table');</script>";
            echo "<script>window.location.href='../html/upload_materials.php';</script>";
            exit();
        }
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('PDF uploaded successfully!');</script>";
        echo "<script>window.location.href='../html/upload_materials.php';</script>";
    } else {
        echo "<script>alert('Upload failed: " . mysqli_error($conn) . "');</script>";
        echo "<script>window.location.href='../html/upload_materials.php';</script>";
    }
}
?>
