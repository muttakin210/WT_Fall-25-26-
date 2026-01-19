<?php include "../db/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Notes</title>
    <link rel="stylesheet" href="../css/search_notes.css">
</head>
<body>
    <div class="container">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by title...">
            <button type="submit">Search</button>
        </form>
        <div class="results">
            </div>
    </div>
</body>
</html>