<?php
$mysqli = new mysqli("db", "root", "rootpassword", "library_db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "MySQLi connection successful!";
?>
