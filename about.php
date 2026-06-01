<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("settings.php");

$result = mysqli_query($conn, "SELECT member_name, project1_tasks, project2_tasks FROM team_contributions");

$page_title = "About Us";
require_once(__DIR__ . "/inc/header.inc");
?>

<main class="about-main">
    <section>
        <h2>Group Information</h2>
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

    <section>
        <h2>Member Contributions</h2>
    </section>

    <div class="team-container">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="member-card">';
                echo '<h3>' . htmlspecialchars($row['member_name']) . '</h3>';
                echo '<div class="task-section">';
                echo '<h4>Project 1 Contributions</h4>';
                echo '<p>' . htmlspecialchars($row['project1_tasks']) . '</p>';
                echo '</div>';
                echo '<div class="task-section">';
                echo '<h4>Project 2 Contributions</h4>';
                echo '<p>' . htmlspecialchars($row['project2_tasks']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No contributions found.</p>";
        }
        mysqli_close($conn);
        ?>
    </div>

    <section>
        <h2>Our Team Photo</h2>
        <figure>
            <img src="images/group_photo.jpeg" alt="A photo of Rafay, Hamnah, and Vansh" style="max-width: 100%; height: auto;">
            <figcaption>The NextGen Web Works team - April 2026</figcaption>
        </figure>
    </section>

    <section>
        <h2>Team Fun Facts</h2>
        <table>
            <caption>Quick facts about our team members</caption>
            <thead>
                <tr>
                    <th scope="col">Member</th>
                    <th scope="col">Dream Job</th>
                    <th scope="col">Coding Snack</th>
                    <th scope="col">Hometown</th>
                </tr>
            </thead>
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

<?php require_once(__DIR__ . "/inc/footer.inc"); ?>