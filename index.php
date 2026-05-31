<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen Web Works - Home</title>
<link rel="stylesheet" href="/project-2/styles/styles.css"><style>
        .hero-bg {
            background-image: linear-gradient(rgba(8, 72, 135, 0.85), rgba(8, 72, 135, 0.85)),
                              url('images/Gemini_Generated_Image_o8qlqro8qlqro8ql.png');
            background-size: cover;
            background-position: center;
            color: #FFFFFF;
        }
    </style>
</head>
<body>

    <?php 
    include_once(__DIR__ . "/inc/header.inc"); 
    include_once(__DIR__ . "/inc/nav.inc"); 
?>

    <main>
        <section class="welcome hero-bg">
            <h2>Welcome to NextGen Web Works</h2>
            <p class="tagline">Designing the Digital Future, Today</p>
            <p>We are a <strong>Creative Digital Media Agency</strong> specializing in web design and branding.</p>
            
            <form action="jobs.php" method="get" class="hero-search">
                <label for="site-search"><strong>Search Job Vacancies:</strong></label>
                <input type="text" id="site-search" name="q" placeholder="e.g. Web Designer">
                <button type="submit" class="cta">Search</button>
            </form>
        </section>

        <section class="services">
            <h2>Our Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <h3>Web Design</h3>
                    <p>Beautiful, responsive website tailored to your needs.</p>
                    <span class="price">$800 - $1500</span>
                </div>
                <div class="service-card">
                    <h3>SEO Optimisation</h3>
                    <p>Boost your visibility and reach more customers.</p>
                    <span class="price">$400 - $900</span>
                </div>
                <div class="service-card">
                    <h3>Custom Enterprise Solutions</h3>
                    <p>Contact us for a specialised quote tailored to your business.</p>
                    <span class="price">$1000+</span>
                </div>
            </div>
        </section>

        <section class="services hours-section">
            <h2>Studio Operating Hours</h2>
            <table>
                <caption>Weekly availability for client consultations</caption>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Monday - Thursday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td>9:00 AM - 3:00 PM</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-style: italic;">
                            Closed Weekends and Public Holidays
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <div class="acknowledgement">
            <div class="ack-text">
                <h2>Acknowledgement of Country</h2>
                <p><em>NextGen Web Works acknowledges the Traditional Owners...</em></p>
            </div>
            <div class="ack-images">
                <img src="images/Aboriginal.webp" alt="Aboriginal flag">
                <img src="images/Torres-2.jpg" alt="Torres Strait Islander flag">
            </div>
        </div>
    </main>

    <?php 
    include_once(__DIR__ . "/inc/footer.inc"); 
?>

</body>
</html>