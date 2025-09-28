<?php require 'db.php';

if (!isset($_GET['id'])) die("No book selected.");
$book_id = intval($_GET['id']);

// Check book
$check = $conn->query("SELECT * FROM books WHERE id=$book_id");
if ($check->num_rows == 0) die("Book not found.");
$book = $check->fetch_assoc();

if ($book['available']) {
    echo "<script>alert('Book is not borrowed.'); window.location='librarian.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $today = date("Y-m-d");

    // Update borrows record
    $conn->query("UPDATE borrows 
                  SET return_date='$today', returned=1
                  WHERE book_id=$book_id AND return_date IS NULL");

    // Update book availability
    $conn->query("UPDATE books SET available=1 WHERE id=$book_id");

    echo "<script>alert('Book returned successfully!'); window.location='librarian.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Return Book</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <h1>Return: <?php echo htmlspecialchars($book['title']); ?></h1>
</div>
<form method="POST" class="form">
    <p>Are you sure you want to return this book?</p>
    <button type="submit" class="btn update">Return Book</button>
    <br><br>
    <a href="librarian.php" class="btn add">Back to Catalog</a>
</form>
</body>
</html>
