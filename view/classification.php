<!DOCTYPE html>
<html lang="en">

<head>
    <title>Classification Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<div class="main-card">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    <div class="internal-card">

        <h1 class="center-text"><?php echo $classificationName; ?> vehicles </h1>

        <div class="messageSuccessOrError">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </div>

        <?php if (!empty($vehicles)) { ?>
            <ul id="inv-display">
                <?php foreach ($vehicles as $vehicle) { ?>
                    <li>
                        <a href="/phpmotors/vehicles/index.php?action=vehicleDetail&invId=<?php echo $vehicle['invId'] ?>" title="vehicle details" id="acc">
                        <?php $invThumbnails= getThumbnailImages($vehicle['invId'] );?>
                            <img src='<?php echo $invThumbnails[1]['imgPath']?>' alt='Image of <?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel'] ?> on phpmotors.com'>
                        </a>
                        <hr>
                        <h2><a href="/phpmotors/vehicles/index.php?action=vehicleDetail&invId=<?php echo $vehicle['invId'] ?>"  title="vehicle details" id="acc"> <?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel'] ?> </a></h2>
                        <?php
                            $price = $vehicle['invPrice'];
                            $formattedPrice = '$' . number_format($price, 2, '.', ',');
                        ?>
                        <span><?php echo $formattedPrice?></span>
                        
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</div>
<script>
    setTimeout(function() {
        var messageDiv = document.querySelector('.messageSuccessOrError');
        messageDiv.style.display = 'none';
    }, 7000); // 7 seconds in milliseconds
</script>