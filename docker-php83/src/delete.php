<?php include 'db.php';

if (!isset($_GET['id'])) {
    die("No book selected.");
}
$id = intval($_GET['id']);

$conn->query("DELETE FROM books WHERE id=$id");

echo "<script>alert('Book deleted successfully!'); window.location='librarian.php';</script>";
