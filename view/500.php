<!DOCTYPE html>
<html lang="en">

<head>
    <title>Error Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-card">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        <!-- <header>
            <img class="logo-image" src="../images/site/logo.png" alt="Logo">
            <p class="my-account">My Account</p>
            <p></p>
            <nav>
                <a href="#">Home</a>
                <a href="#">Classic</a>
                <a href="#">Sports</a>
                <a href="#">SUV</a>
                <a href="#">Trucks</a>
                <a href="#">Used</a>
            </nav>
        </header> -->

        <div class="internal-card">
            <h1>Server Error</h1> 
            <p>Sorry our server seems to be experiencing some technical difficulties. Please check back later</p>          
            <!-- Footer -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
            <!--
            <footer>
                <div class="footer_motors">
                    <hr>
                    <p>&copy; PHP Motors. All Rights Reserved.</p>
                    <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed. </p>
                    <p class="last-update"> last Update: 30 Marc, 2018</p>
                </div>
            </footer> -->
        </div>
    </div>
</body>