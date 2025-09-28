<?php
require 'db.php';

$book = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM books WHERE id = $id");
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Book not found.");
    }
}

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $publisher = $conn->real_escape_string($_POST['publisher']);
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $year_published = intval($_POST['year_published']);
    $available = isset($_POST['available']) ? 1 : 0;

    $update_sql = "UPDATE books 
                   SET title='$title', author='$author', publisher='$publisher', 
                       isbn='$isbn', year_published=$year_published, available=$available
                   WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Book updated successfully!'); window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . addslashes($conn->error) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">    
    <h1>Edit Book</h1>
</div>

<?php if ($book): ?>
<form method="POST" action="" class="form">
    <input type="hidden" name="id" value="<?= $book['id'] ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br><br>

    <label>Publisher:</label><br>
    <input type="text" name="publisher" value="<?= htmlspecialchars($book['publisher']) ?>" required><br><br>

    <label>ISBN:</label><br>
    <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" required><br><br>

    <label>Year Published:</label><br>
    <input type="number" name="year_published" value="<?= htmlspecialchars($book['year_published']) ?>" required><br><br>

    <label>
        <input type="checkbox" name="available" <?= $book['available'] ? 'checked' : '' ?>>
        Available
    </label>
    <br><br>

    <button type="submit" name="update" class="btn update">Update Book</button>
    <br><br>
    <a href="index.php" class="btn add">Back to Catalog</a>
</form>
<?php endif; ?>

</body>
</html>
