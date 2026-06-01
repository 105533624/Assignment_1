<?php
/**
 * Database Settings
 * This file contains the credentials for the MySQL database.
 */

$host = "localhost";
$user = "root";
$pwd  = "";
$sql_db = "nextgenwebworks";

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    $error_message = mysqli_connect_error();
    $error_code = mysqli_connect_errno();
    
    error_log("Database connection failed [{$error_code}]: {$error_message}");
    
    die("
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; 
                    padding: 20px; border: 2px solid #c0392b; border-radius: 8px; 
                    background: #fdf2f2; color: #c0392b;'>
            <h2>⚠️ Service Temporarily Unavailable</h2>
            <p>We are unable to connect to the database at this time.</p>
            <p>Please try again later or contact 
                <a href='mailto:info@nextgenwebworks.com'>info@nextgenwebworks.com</a>
            </p>
        </div>
    ");
}

mysqli_set_charset($conn, "utf8mb4");
?>
