<?php
require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Librarian Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>Librarian Dashboard</h1>
</div>

<div style="margin-bottom: 20px;">
    <a href="index.php" class="btn add">Return to Homepage</a> 
    <a href="add.php" class="btn add">Add Book</a>
</div>

<!-- Book Search Form -->
<you insert your code @Dejito here>

<!-- Browse Catalog -->
<h2>All Books (Catalog)</h2>
<table>
<tr>
    <th>Title</th><th>Author</th><th>Publisher</th><th>Year</th><th>Available</th><th>Actions</th>
</tr>
<?php
// <you insert your code @Dejito here> (book search loop)
?>
</table>

<!-- Borrowed Books Search Form -->
<you insert your code @Dejito here>

<table>
<tr>
    <th>Book Title</th><th>Borrower</th><th>Borrow Date</th><th>Return Date</th><th>Status</th>
</tr>
<?php
// <you insert your code @Dejito here> (borrowed books loop)
?>
</table>
</body>
</html>
