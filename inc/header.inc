<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NextGen Web Works - Digital Media Agency">
    <meta name="keywords" content="web design, branding, digital agency, Melbourne">
    <meta name="author" content="Vansh and Hamnah">
    
    <title>NextGen Web Works - <?php echo isset($page_title) ? $page_title : 'Home'; ?></title>
    
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/logo.png" alt="NextGen Web Works Logo" width="100">
        <div class="logo-text">
            <h1>NextGen Web Works</h1>
        </div>
    </div>
    <?php include_once(__DIR__ . "/nav.inc"); ?>
</header>
