<?php
try {
    $pdo = new PDO("mysql:host=db;dbname=library_db", "root", "root");
    echo "PDO connection successful!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
