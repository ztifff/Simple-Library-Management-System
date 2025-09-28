<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
     <h1>Add a New Book</h1>
    </div>
   <br>

    <form action="" method="post" class="form">
        <!-- Title -->
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <!-- Author -->
        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br><br>

        <!-- Publisher -->
        <label for="publisher">Publisher:</label><br>
        <input type="text" id="publisher" name="publisher" required><br><br>

        <!-- Year Published -->
        <label for="year">Year Published:</label><br>
        <input type="number" id="year_published" name="year_published" min="1000" max="2025" step="1" required><br><br>

        <!-- ISBN -->
        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn" pattern="[0-9]{13}" placeholder="13-digit ISBN" required><br><br>

        <button type="submit" class="btn update">Add Book</button>
        <br>

        <br>
        <a href="index.php" class="btn add">Back to Catalog Book</a>
    </form><br><br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $conn->real_escape_string($_POST['title']);
        $author = $conn->real_escape_string($_POST['author']);
        $publisher = $conn->real_escape_string($_POST['publisher']);
        $year = intval($_POST['year_published']);
        $isbn = $conn->real_escape_string($_POST['isbn']);
        $available = 1;

        // Insert query - Book ID is auto-increment, so not included here
        $sql = "INSERT INTO books (title, author, publisher, isbn, year_published, available) 
                VALUES ('$title', '$author', '$publisher','$isbn', '$year', '$available')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Book added successfully!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($conn->error) . "');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>

