<!DOCTYPE html>
<html>
<head>
    <title>Upload Materials | AIUB Notes</title>
    <link rel="stylesheet" href="../css/upload_materials.css">
</head>
<body>

<div class="navbar">
    <h2>AIUB Notes – Admin</h2>
    <a href="../php/logout.php">Logout</a>
</div>

<div class="container">
    <h1>Upload Materials</h1>
    <p>Share notes, slides, or course materials with your students</p>

    <div class="upload-box">
        <form action="../php/upload_materials.php" method="POST" enctype="multipart/form-data">
            
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Material title" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Write a short description" required></textarea>

            <label for="file">Select File</label>
            <input type="file" name="file" id="file" required>

            <button type="submit" name="upload">Upload</button>
        </form>
    </div>
</div>

</body>
</html>
