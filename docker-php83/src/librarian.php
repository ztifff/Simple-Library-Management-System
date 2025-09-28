<?php
require 'db.php';
?>

<?php
// --- Book Search ---
$bookQuery = "";
$whereBooks = "";
if (isset($_GET['q']) && $_GET['q'] != "") {
    $bookQuery = $conn->real_escape_string($_GET['q']);
    $whereBooks = "WHERE title LIKE '%$bookQuery%' OR author LIKE '%$bookQuery%' OR publisher LIKE '%$bookQuery%' OR isbn LIKE '%$bookQuery%'";
}
$books = $conn->query("SELECT * FROM books $whereBooks ORDER BY title ASC");

// --- Borrowed Books Search ---
$borrowQuery = "";
$whereBorrowed = "";
$statusFilter = "";

if (isset($_GET['qBorrow']) && $_GET['qBorrow'] != "") {
    $borrowQuery = $conn->real_escape_string($_GET['qBorrow']);
    $whereBorrowed = "WHERE b.title LIKE '%$borrowQuery%' OR br.borrower LIKE '%$borrowQuery%'";
}

if (isset($_GET['status']) && $_GET['status'] !== "") {
    $statusFilter = (int)$_GET['status'];
    $whereBorrowed .= ($whereBorrowed ? " AND" : " WHERE") . " br.returned=$statusFilter";
}

$borrowedBooks = $conn->query("
    SELECT b.title, br.borrower, br.borrow_date, br.return_date, br.returned
    FROM borrows br
    JOIN books b ON br.book_id = b.id
    $whereBorrowed
    ORDER BY br.borrow_date DESC
");
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
<form method="GET" class="search-form">
    <input type="text" name="q" placeholder="Search by title, author, publisher, ISBN" value="<?= htmlspecialchars($bookQuery) ?>">
    <button type="submit">Search</button>
</form>

<!-- Browse Catalog -->
<h2>All Books (Catalog)</h2>
<table>
<tr>
    <th>Title</th><th>Author</th><th>Publisher</th><th>Year</th><th>Available</th><th>Actions</th>
</tr>
<?php
if ($books->num_rows > 0) {
    while ($row = $books->fetch_assoc()) {
        echo "<tr>
            <td>".htmlspecialchars($row['title'])."</td>
            <td>".htmlspecialchars($row['author'])."</td>
            <td>".htmlspecialchars($row['publisher'])."</td>
            <td>".$row['year_published']."</td>
            <td>".($row['available'] ? 'Yes' : 'No')."</td>
            <td>
                <a href='edit.php?id={$row['id']}' class='edit'>Edit</a> 
                <a href='delete.php?id={$row['id']}' class='delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        if (!$row['available']) {
            echo " <a href='return.php?id={$row['id']}' class='return'>Return</a>";
        }
        echo "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No books found.</td></tr>";
}
?>
</table>

<!-- Borrowed Books Search Form -->
<h2>Borrowed Books Log</h2>
<form method="GET" class="search-form">
    <input type="text" name="qBorrow" placeholder="Search by book title or borrower" value="<?= htmlspecialchars($borrowQuery) ?>">
    <select name="status">
        <option value="">All</option>
        <option value="0" <?= (isset($_GET['status']) && $_GET['status']=="0") ? "selected" : "" ?>>Borrowed</option>
        <option value="1" <?= (isset($_GET['status']) && $_GET['status']=="1") ? "selected" : "" ?>>Returned</option>
    </select>
    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>Book Title</th><th>Borrower</th><th>Borrow Date</th><th>Return Date</th><th>Status</th>
</tr>
<?php
if ($borrowedBooks->num_rows > 0) {
    while ($row = $borrowedBooks->fetch_assoc()) {
        echo "<tr>
            <td>".htmlspecialchars($row['title'])."</td>
            <td>".htmlspecialchars($row['borrower'])."</td>
            <td>".$row['borrow_date']."</td>
            <td>".($row['return_date'] ?: 'Not yet returned')."</td>
            <td>".($row['returned'] ? 'Returned' : 'Borrowed')."</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No borrow records found.</td></tr>";
}
?>
</table>
</body>
</html>
