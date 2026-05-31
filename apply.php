<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="description" content="Apply Page">
    <meta name="author" content="Hamnah">
  <link rel="stylesheet" href="/project-2/styles/styles.css"><title>Apply - NextGen Web Works</title>
    <style>
        fieldset { border: 2px solid #084887; border-radius: 8px; padding: 1.5em; margin-bottom: 1.5em; background-color: #f9fafc; }
        fieldset legend { color: #084887; padding: 0 0.5em; }
    </style>
</head>
<body>
    <?php include_once("inc/header.inc"); ?>

    <main>
        <section class="form-section">
            <h2 style="text-align: center;">Apply for a Position</h2>
            
            <form class="form-container" method="post" action="process_eoi.php" novalidate>    
                
                <fieldset>
                    <legend><b>Job Application Details</b></legend>
                    <label for="jobref">Job reference number</label>
                    <input type="text" id="jobref" name="jobref" required>
                    
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" required>
                    
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" required>
                    
                    <label for="date">Date of birth</label>
                    <input type="date" id="date" name="date" required>
                </fieldset>

                <fieldset>
                    <legend><b>Gender</b></legend>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                </fieldset>

                <fieldset>
                    <legend><b>Address</b></legend>
                    <label for="street">Street Address</label>
                    <input type="text" id="street" name="street" required>
                    
                    <label for="suburb">Suburb/Town</label>
                    <input type="text" id="suburb" name="suburb" required>
                    
                    <label for="state">State</label>
                    <select id="state" name="state" required>
                        <option value="" disabled selected>Please Select</option> 
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option> 
                        <option value="QLD">QLD</option> 
                        <option value="NT">NT</option> 
                        <option value="WA">WA</option> 
                        <option value="SA">SA</option> 
                        <option value="TAS">TAS</option> 
                        <option value="ACT">ACT</option>
                    </select>

                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode" required>
                </fieldset>

                <fieldset>
                    <legend><b>Contact Information</b></legend>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="phone">Phone number</label>
                    <input type="text" id="phone" name="phone" required>
                </fieldset>

                <fieldset>
                    <legend><b>Skills Needed</b></legend>
                    <ul>
                        <li>
                            <input type="checkbox" id="skill-html" name="skills[]" value="HTML">
                            <label for="skill-html">HTML</label>
                        </li>
                        <li>
                            <input type="checkbox" id="skill-css" name="skills[]" value="CSS">
                            <label for="skill-css">CSS</label>
                        </li>
                        <li>
                            <input type="checkbox" id="skill-js" name="skills[]" value="JavaScript">
                            <label for="skill-js">JavaScript</label>
                        </li>
                    </ul>   
                </fieldset>

                <fieldset>
                    <legend><b>Other Skills</b></legend>
                    <textarea id="otherskills" name="otherskills" rows="4" cols="50" placeholder="List other skills..."></textarea>
                </fieldset>

                <div class="form-buttons">
                    <button type="submit">Submit Application</button>
                    <button type="reset">Reset Form</button>
                </div>
            </form>
        </section>
    </main>

    <?php include_once("inc/footer.inc"); ?>
</body>
</html>