<?php require 'db.php';

if (!isset($_GET['id'])) {
    die("No book selected.");
}
$book_id = intval($_GET['id']);

// Check book
$check = $conn->query("SELECT * FROM books WHERE id=$book_id");
if ($check->num_rows == 0) die("Book not found.");
$book = $check->fetch_assoc();

if (!$book['available']) {
    echo "<script>alert('This book is already borrowed.'); window.location='user.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $borrower = $conn->real_escape_string($_POST['borrower']);
    $today = date("Y-m-d");

    // Insert borrow record
    $conn->query("INSERT INTO borrows (book_id, borrower, borrow_date, returned)
                  VALUES ($book_id, '$borrower', '$today', 0)");

    // Update book availability
    $conn->query("UPDATE books SET available=0 WHERE id=$book_id");

    echo "<script>alert('Book borrowed successfully!'); window.location='user.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Borrow Book</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
  <h1>Borrow: <?php echo htmlspecialchars($book['title']); ?></h1>
</div>
<form method="POST" class="form">
    <label>Borrower Name:</label>
    <input type="text" name="borrower" required>
    <button type="submit" class="btn update">Borrow Book</button>
    <br><br>
    <a href="user.php" class="btn add">Back to Catalog</a>
</form>
</body>
</html>
