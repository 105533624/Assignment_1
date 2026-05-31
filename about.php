<!-- Generative AI tool (e.g., ChatGPT) was used for suggestions, code improvement,adding comments and image generation.All AI-generated code was reviewed and modified by the author before use. -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <!-- =========================
         META DATA + PAGE INFO
    ========================== -->
    <meta charset="UTF-8"> <!-- Supports all characters (important for Urdu/Punjabi text) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Makes site responsive -->
    <title>NextGen Web Works - About Us</title> <!-- Browser tab title -->
    <link rel="stylesheet" href="/project-2/styles/styles.css"> <!-- External CSS file -->
    <!-- =========================
         EMBEDDED CSS (page-specific styles)
    ========================== -->
    <style>
        figure {
            border: 3px solid #084887; /* Blue border */
            padding: 15px; /* Space inside */
            margin: 2em auto; /* Center horizontally */
            max-width: 700px; /* Limits width */
            text-align: center;
            border-radius: 8px;
            background-color: #f9fafc; /* Light background */
        }
    </style>
</head>
<body>
    <!-- =========================
         HEADER (LOGO + NAVIGATION)
    ========================== -->
     <?php 
    include_once(__DIR__ . "/inc/header.inc"); 
?>
    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <main>
        <h2>About Our Team</h2>
        <!-- Group information section -->
        <section>
            <h3>Group Information</h3>
            <ul> 
                <li><strong>Group name:</strong> NextGen Web Works</li>
                <li><strong>Class Schedule:</strong>
                    <ul>
                        <li>Day: Wednesday</li>
                        <li>Time: 4:30PM to 6:30PM</li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- Member contributions using description list -->
        <section>
            <h3>Member Contributions</h3>
            <dl class="about-dl">
                <!-- Member 1 -->
                <dt><strong>Rafay</strong> <mark>106099114</mark></dt>
                <dd>Responsible for about.html and its CSS. Also contributed to planning and testing.</dd>
                <dd>
                    <q lang="ur">محنت کامیابی کی کنجی ہے۔</q> 
                    ("Hard work is the key to success.")
                </dd>
                <!-- Member 2 -->
                <dt><strong>Hamnah</strong> <mark>106178479</mark></dt>
                <dd>Built apply.html with validation and responsive layout. Assisted with index.html and CSS.</dd>
                <dd>
                    <q lang="ur">علم سب سے بڑی دولت ہے۔</q> 
                    ("Knowledge is the greatest wealth.")
                </dd>
                <!-- Member 3 -->
                <dt><strong>Vansh</strong> <mark>105533624</mark></dt>
                <dd>Built index.html and jobs.html. Helped with CSS and managed GitHub + Jira.</dd>
                <dd>
                    <q lang="pa">ਮਿਹਨਤ ਦਾ ਫਲ ਮਿੱਠਾ ਹੁੰਦਾ ਹੈ।</q>
                    ("The fruit of hard work is sweet.")
                </dd>
            </dl>
        </section>
        <!-- Team photo section -->
        <section>
            <h3>Our Team Photo</h3>
            <figure>
                <img src="images/group_photo.jpeg" alt="A photo of Rafay, Hamnah, and Vansh" style="max-width: 100%; height: auto;">
                <figcaption>The NextGen Web Works team in the studio - April 2026</figcaption>
            </figure>
        </section>
        <!-- Table section -->
        <section>
            <h3>Team Fun Facts</h3>
            <table>
                <caption>Quick facts about our team members</caption> <!-- Table title -->
                <!-- Table header -->
                <thead>
                    <tr>
                        <th scope="col">Member</th>
                        <th scope="col">Dream Job</th>
                        <th scope="col">Coding Snack</th>
                        <th scope="col">Hometown</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    <tr>
                        <td>Rafay</td>
                        <td>Cricketer</td>
                        <td>Cheese</td>
                        <td>Lahore</td>
                    </tr>
                    <tr>
                        <td>Hamnah</td>
                        <td>AI Engineer</td>
                        <td>Ice Cream</td>
                        <td>Islamabad</td>
                    </tr>
                    <tr>
                        <td>Vansh</td>
                        <td>Cricketer</td>
                        <td>Takis</td>
                        <td>Chandigarh</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <!-- =========================
         FOOTER
    ========================== -->
    <?php 
    include_once(__DIR__ . "/inc/footer.inc"); 
?>
</body>
</html>
