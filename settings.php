<?php
/**
 * Database Settings
 * This file contains the credentials for the MySQL database.
 */

$host = "localhost";    // Usually localhost
$user = "root";         // Default XAMPP username
$pwd  = "";             // Default XAMPP password is empty
$sql_db = "nextgenwebworks"; // The database name you created in phpMyAdmin

// The "Phone Line" - Establishing the connection
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// Check if the connection works
if (!$conn) {
    // If it fails, stop the script and show the error
    die("Database connection failed: " . mysqli_connect_error());
}

// If it works, $conn is now a global variable you can use in other files
?>