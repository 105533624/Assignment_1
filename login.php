<?php
session_start(); // Start the session at the very beginning of the script to enable session management and access to $_SESSION superglobal for storing user login state and other session data.
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("settings.php");
$error_msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_input = trim($_POST["username"]);
    $pass_input = trim($_POST["password"]);
    if ($user_input != "" && $pass_input != "") {
        $safe_user = mysqli_real_escape_string($conn, $user_input);
        $sql_query = "SELECT * FROM users WHERE username = '$safe_user'";
        $query_result = mysqli_query($conn, $sql_query);

        if ($query_result && mysqli_num_rows($query_result) > 0) {
            $user_row = mysqli_fetch_assoc($query_result);
            
            // basic text comparison for password
            if ($pass_input === $user_row['password']) {
                $_SESSION["authenticated"] = true;
                $_SESSION["username"] = $user_row['username'];
                
                // go to dashboard
                header("Location: manage.php");
                exit();
            } else {
                $error_msg = "Wrong username or password.";
            }
        } else {
            $error_msg = "Wrong username or password.";
        }
        mysqli_free_result($query_result);
    } else {
        $error_msg = "Both fields are required.";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Portal</title>
    <link rel="stylesheet" href="/project-2/styles/styles.css">
</head>
<body>
    <?php include_once("inc/header.inc"); ?>

    <main style="max-width: 400px; margin: 50px auto; padding: 20px;">
        <form class="form-container" method="post" action="login.php" style="padding: 20px; border: 1px solid #ccc;">
            <h2 style="text-align: center;">Staff Login</h2>
            
            <?php if ($error_msg != ""): ?>
                <p style="color: red; text-align: center;">
                    <?php echo $error_msg; ?>
                </p>
            <?php endif; ?>

            <p>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required style="width:100%; padding:6px;">
            </p>

            <p>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required style="width:100%; padding:6px;">
            </p>

            <p style="text-align: center;">
                <button type="submit" class="cta" style="width: 100%;">Log In</button>
            </p>
        </form>
    </main>

    <?php include_once("inc/footer.inc"); ?>
</body>
</html>
        
