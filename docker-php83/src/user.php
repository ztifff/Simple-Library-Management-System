<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Library Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>User Library Catalog</h1>
    </div>

    <div style="text-align:center; margin-bottom: 20px;">
        <a href="index.php" class="btn add">Return to Homepage</a>
    </div>

    <!-- Available Books -->
    <h2>Available Books</h2>
    <table>
        <tr>
            <th>Title</th><th>Author</th><th>Publisher</th><th>Year</th><th>Available</th><th>Actions</th>
        </tr>
        <?php
        // <you insert your code @Dejito: fetch all books without search>
        $result = $conn->query("SELECT * FROM books ORDER BY title ASC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['publisher']}</td>
                    <td>{$row['year_published']}</td>
                    <td>" . ($row['available'] ? 'Yes' : 'No') . "</td>
                    <td>";
                if ($row['available']) {
                    echo "<form method='POST' action='borrow.php?id={$row['id']}' style='display:inline;'>
                            <input type='text' name='borrower' placeholder='Your Name' required>
                            <button type='submit' class='btn update'>Borrow</button>
                          </form>";
                } else {
                    echo "<a href='return.php?id={$row['id']}' class='return'>Return</a>";
                }
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No books found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
