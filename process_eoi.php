<?php
// 1. Enable Error Reporting for Development Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Security Check: Block direct URL access
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["jobref"])) {
    header("Location: apply.php");
    exit();
}

// 3. Connect to Database using settings.php
require_once("settings.php");

// 4. Create eoi table automatically if it doesn't exist yet
$table_query = "CREATE TABLE IF NOT EXISTS eoi (
    eoi_id INT AUTO_INCREMENT PRIMARY KEY,
    jobref VARCHAR(5) NOT NULL,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    street VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode VARCHAR(4) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    skills TEXT,
    otherskills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New' NOT NULL
)";

// Catch any database layout creation crashes immediately
if (!mysqli_query($conn, $table_query)) {
    die("<div style='color:red; background:yellow; padding:20px; font-weight:bold; font-family:sans-serif;'>
        DATABASE ERROR: Table creation failed! <br>Reason: " . mysqli_error($conn) . "
    </div>");
}

// 5. Sanitize and Clean Input Data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$jobref      = clean_input($_POST["jobref"]);
$firstname   = clean_input($_POST["firstname"]);
$lastname    = clean_input($_POST["lastname"]);
$dob         = clean_input($_POST["date"]);
$gender      = isset($_POST["gender"]) ? clean_input($_POST["gender"]) : "";
$street      = clean_input($_POST["street"]);
$suburb      = clean_input($_POST["suburb"]);
$state       = isset($_POST["state"]) ? clean_input($_POST["state"]) : "";
$postcode    = clean_input($_POST["postcode"]);
$email       = clean_input($_POST["email"]);
$phone       = clean_input($_POST["phone"]);
$otherskills = isset($_POST["otherskills"]) ? clean_input($_POST["otherskills"]) : "";

// Process checkbox arrays safely
$skills_array = isset($_POST["skills"]) ? $_POST["skills"] : [];
$skills_string = implode(", ", array_map('clean_input', $skills_array));

// 6. Server-Side Validation Rules
$errors = [];

// Job Reference: Exactly 5 alphanumeric characters
if (!preg_match("/^[a-zA-Z0-9]{5}$/", $jobref)) {
    $errors[] = "Job reference number must be exactly 5 alphanumeric characters.";
}

// First Name: Max 20 alpha characters
if (empty($firstname) || !preg_match("/^[a-zA-Z]{1,20}$/", $firstname)) {
    $errors[] = "First name is required and can only contain up to 20 letters.";
}

// Last Name: Max 20 alpha characters
if (empty($lastname) || !preg_match("/^[a-zA-Z]{1,20}$/", $lastname)) {
    $errors[] = "Last name is required and can only contain up to 20 letters.";
}

// Date of Birth validation & Age Check (Must be between 15 and 80)
if (empty($dob)) {
    $errors[] = "Date of birth is required.";
} else {
    $birthDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    if ($age < 15 || $age > 80) {
        $errors[] = "Applicant must be between 15 and 80 years old.";
    }
}

// Gender Check
if (empty($gender)) {
    $errors[] = "Gender selection is required.";
}

// Street Address: Max 40 characters
if (empty($street) || strlen($street) > 40) {
    $errors[] = "Street address is required and cannot exceed 40 characters.";
}

// Suburb/Town: Max 40 characters
if (empty($suburb) || strlen($suburb) > 40) {
    $errors[] = "Suburb/Town is required and cannot exceed 40 characters.";
}

// State Check
if (empty($state)) {
    $errors[] = "Please select a valid Australian state.";
}

// Postcode: Exactly 4 digits and match selected State rules
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
} else {
    $first_digit = $postcode[0];
    if ($state === "VIC" && $first_digit !== '3' && $first_digit !== '8') $errors[] = "VIC postcodes must start with 3 or 8.";
    if ($state === "NSW" && $first_digit !== '1' && $first_digit !== '2') $errors[] = "NSW postcodes must start with 1 or 2.";
    if ($state === "QLD" && $first_digit !== '4' && $first_digit !== '9') $errors[] = "QLD postcodes must start with 4 or 9.";
    if ($state === "NT"  && $first_digit !== '0') $errors[] = "NT postcodes must start with 0.";
    if ($state === "WA"  && $first_digit !== '6') $errors[] = "WA postcodes must start with 6.";
    if ($state === "SA"  && $first_digit !== '5') $errors[] = "SA postcodes must start with 5.";
    if ($state === "TAS" && $first_digit !== '7') $errors[] = "TAS postcodes must start with 7.";
    if ($state === "ACT" && $first_digit !== '0') $errors[] = "ACT postcodes must start with 0.";
}

// Email Validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

// Phone Number: 8 to 12 digits
if (!preg_match("/^[0-9]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be between 8 and 12 digits long.";
}

// 7. Handle Validation Outcome
if (count($errors) > 0) {
    // Show validation failure summary page
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head><title>Validation Errors</title><link rel='stylesheet' href='/project-2/styles/styles.css'></head>";
    echo "<body>";
    include_once("inc/header.inc"); // Contains your combined Header + Nav links
    echo "<main style='padding: 2em; max-width: 600px; margin: auto;'>";
    echo "<h2 style='color: #cc0000;'>Application Submission Failed</h2>";
    echo "<p>Please review and resolve the following errors:</p>";
    echo "<ul style='color: #cc0000; margin-bottom: 2em;'>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo "<p><a href='apply.php' class='cta' style='text-align:center;'>Return to Form</a></p>";
    echo "</main>";
    include_once("inc/footer.inc");
    echo "</body>";
    echo "</html>";
} else {
    // 8. DB Insertion (Escape data to guard against SQL injection strings)
    $jobref_escaped    = mysqli_real_escape_string($conn, $jobref);
    $firstname_escaped = mysqli_real_escape_string($conn, $firstname);
    $lastname_escaped  = mysqli_real_escape_string($conn, $lastname);
    $dob_escaped       = mysqli_real_escape_string($conn, $dob);
    $gender_escaped    = mysqli_real_escape_string($conn, $gender);
    $street_escaped    = mysqli_real_escape_string($conn, $street);
    $suburb_escaped    = mysqli_real_escape_string($conn, $suburb);
    $state_escaped     = mysqli_real_escape_string($conn, $state);
    $postcode_escaped  = mysqli_real_escape_string($conn, $postcode);
    $email_escaped     = mysqli_real_escape_string($conn, $email);
    $phone_escaped     = mysqli_real_escape_string($conn, $phone);
    $skills_escaped    = mysqli_real_escape_string($conn, $skills_string);
    $others_escaped    = mysqli_real_escape_string($conn, $otherskills);

    $insert_query = "INSERT INTO eoi (jobref, firstname, lastname, dob, gender, street, suburb, state, postcode, email, phone, skills, otherskills, status) 
                     VALUES ('$jobref_escaped', '$firstname_escaped', '$lastname_escaped', '$dob_escaped', '$gender_escaped', '$street_escaped', '$suburb_escaped', '$state_escaped', '$postcode_escaped', '$email_escaped', '$phone_escaped', '$skills_escaped', '$others_escaped', 'New')";

    if (mysqli_query($conn, $insert_query)) {
        $generated_id = mysqli_insert_id($conn);
        
        // Show application success page
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head><title>Application Successful</title><link rel='stylesheet' href='/project-2/styles/styles.css'></head>";
        echo "<body>";
        include_once("inc/header.inc"); // Contains your combined Header + Nav links
        echo "<main style='padding: 3em; text-align: center; max-width: 600px; margin: auto;'>";
        echo "<h2 style='color: #084887;'>Application Submitted Successfully!</h2>";
        echo "<p style='font-size: 1.2em; margin: 1.5em 0;'>Your unique Application Reference ID is: <strong>" . $generated_id . "</strong></p>";
        echo "<p>Thank you for applying. Our HR group will review your details shortly.</p>";
        echo "</main>";
        include_once("inc/footer.inc");
        echo "</body>";
        echo "</html>";
    } else {
        die("<div style='color:red; background:yellow; padding:20px; font-weight:bold; font-family:sans-serif;'>
            SQL INSERTION CRASH: Failed to save application record! <br>Reason: " . mysqli_error($conn) . "
        </div>");
    }
}

// Close connection instance
mysqli_close($conn);
?>