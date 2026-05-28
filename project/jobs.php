<?php
require_once("settings.php");

/* =========================
   DATABASE CONNECTION
========================= */
$conn = mysqli_connect($db_host, $db_user, $db_pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

/* =========================
   SEARCH + SORT
========================= */
$search = "";
$sort = "title ASC";

$sql = "SELECT * FROM jobs";

$params = [];
$types = "";

/* SEARCH */
if (isset($_GET["search"]) && !empty(trim($_GET["search"]))) {

    $search = trim($_GET["search"]);

    $sql .= " WHERE title LIKE ? OR description LIKE ? OR job_reference LIKE ?";

    $search_term = "%$search%";

    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;

    $types .= "sss";
}

/* SORT */
if (isset($_GET["sort"])) {
    switch ($_GET["sort"]) {
        case "salary":
            $sort = "salary ASC";
            break;
        case "closing":
            $sort = "closing_date ASC";
            break;
        default:
            $sort = "title ASC";
    }
}

$sql .= " ORDER BY $sort";

$stmt = mysqli_prepare($conn, $sql);

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

include("includes/header.inc");
include("includes/nav.inc");
?>

<main class="jobs-container">

    <!-- LEFT SIDE -->
    <div class="jobs-main">

        <div class="jobs-intro">
            <p>Browse our current openings below. Applications are reviewed within 5 business days.</p>
        </div>

        <form method="get" action="jobs.php" class="search-form">

            <input type="text" name="search"
                placeholder="Search jobs..."
                value="<?php echo htmlspecialchars($search); ?>">

            <select name="sort">
                <option value="title">Sort by Title</option>
                <option value="salary">Sort by Salary</option>
                <option value="closing">Sort by Closing Date</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<p class='no-results'>No jobs found.</p>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <section class="job-listing">

            <h2>
                <?php echo htmlspecialchars($row["title"]); ?>
                <span class="ref-number">
                    <?php echo htmlspecialchars($row["job_reference"]); ?>
                </span>
            </h2>

            <p>
                <span class="salary-tag">
                    <?php echo htmlspecialchars($row["salary"]); ?>
                </span>
                | <strong>Reports to:</strong>
                <?php echo htmlspecialchars($row["reports_to"]); ?>
            </p>

            <p><?php echo htmlspecialchars($row["description"]); ?></p>

            <h3>Key Responsibilities</h3>
            <ul>
                <?php
                foreach (explode("\n", $row["responsibilities"]) as $item) {
                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                }
                ?>
            </ul>

            <h3>Essential Requirements</h3>
            <ul>
                <?php
                foreach (explode("\n", $row["essential_requirements"]) as $item) {
                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                }
                ?>
            </ul>

            <h3>Preferred Requirements</h3>
            <ul>
                <?php
                foreach (explode("\n", $row["preferred_requirements"]) as $item) {
                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                }
                ?>
            </ul>

            <p class="closing-date">
                <em>Applications close on <?php echo htmlspecialchars($row["closing_date"]); ?></em>
            </p>

            <a class="cta"
               href="apply.php?jobref=<?php echo urlencode($row["job_reference"]); ?>">
               Apply Now
            </a>

        </section>

        <?php } ?>

    </div>

    <!-- RIGHT SIDE -->
    <aside class="benefits-sidebar">

        <h2>Why Join Us?</h2>
        <p>
            We offer flexible working hours, remote options,
            and a dedicated creative environment.
        </p>

        <p>
            We prioritise inclusive design and accessibility.
        </p>

    </aside>

</main>

<?php include("includes/footer.inc"); ?>