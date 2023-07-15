<!DOCTYPE html>
<html lang="en">

<head>
    <title>Review Edit Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<?php 
    require_once '../model/reviews-model.php';
    require_once '../model/accounts-model.php';
    require_once '../model/vehicles-model.php';
?>

<div class="main-card">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    <div class="internal-card">
        <div class="vehicle-card">

            <form method="post" action="/phpmotors/reviews/index.php">
                <?php
                $reviewToEdit = getReviewsByReviewId($_SESSION['reviewId']); 
                $preFilledText = $reviewToEdit['reviewText'] ;
                if (isset($_POST['reviewText'])) {
                    // If the form has been submitted, use the submitted value
                    $preFilledText = $_POST['reviewText'];
                }
                ?>
                <label for="reviewText">Review Text:</label><br>
                <textarea name="reviewText" rows="5" cols="30" required><?php echo $preFilledText; ?> </textarea><br><br>

                <input type="hidden" name="action" value="update-review">
               
                <input class="button-edit" role="button-edit" type="submit" value="Update"><br><br>
            </form>
        </div>

        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</div>