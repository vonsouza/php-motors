<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vehicle Detail Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<div class="main-card">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    <div class="internal-card">
        <div class="vehicle-card">

            <h1 class="vehicle-title"><span><?php echo $_SESSION['invDetail'][0]['invMake'] . ' ' . $_SESSION['invDetail'][0]['invModel']; ?> </span></h1>

            <img class="vehicle-img img-box" src="<?php echo $_SESSION['invDetail'][0]['invImage']; ?>" alt="image"><br>

            <!-- Thumbnails from images table -->
            <?php if (isset($_SESSION['invThumbnails'][1]['imgPath'])) { ?>
                <img class="vehicle-thumbnail" src="<?php echo $_SESSION['invThumbnails'][1]['imgPath']; ?>" alt="thumbnail">
            <?php } ?>
            <?php if (isset($_SESSION['invThumbnails'][3]['imgPath'])) { ?>
                <img class="vehicle-thumbnail" src="<?php echo $_SESSION['invThumbnails'][3]['imgPath']; ?>" alt="thumbnail">
            <?php } ?>
            <?php if (isset($_SESSION['invThumbnails'][5]['imgPath'])) { ?>
                <img class="vehicle-thumbnail" src="<?php echo $_SESSION['invThumbnails'][5]['imgPath']; ?>" alt="thumbnail">
            <?php } ?>
            <br><br>
            <hr>
            <span class="vehicle-text"><?php echo $_SESSION['invDetail'][0]['invMake'] . ' ' . $_SESSION['invDetail'][0]['invModel']; ?> Details: </span> <br><br>

            <span class="vehicle-description"><?php echo $_SESSION['invDetail'][0]['invDescription']; ?> </span> <br><br>

            <span class="vehicle-text"> Color: <?php echo $_SESSION['invDetail'][0]['invColor']; ?> </span><br><br>

            <?php
                $price = $_SESSION['invDetail'][0]['invPrice'];
                $formattedPrice = '$' . number_format($price, 2, '.', ',');
            ?>

            <span class="vehicle-price"> Price: <?php echo $formattedPrice; ?> </span><br><br>
            <hr>
        </div>
        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</div>

<script>
    function formatCurrencyUSD(amount) {
        const parsedAmount = parseFloat(amount);
        if (isNaN(parsedAmount)) {
            return '';
        }
        return parsedAmount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        }
</script>