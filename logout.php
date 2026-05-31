<?php
// Part 1
session_start();

// Part 2
$_SESSION = array();

// Part 3
session_destroy();

// Part 4
header("Location: login.php");
exit();
?>