<!DOCTYPE html>
<html lang="en">

<head>
    <title>Review Delete Page</title>
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
                <h2> You are deleting a review. Are you sure?</h2>
                <?php 
                $reviewBeenDeleted = getReviewsByReviewId($_SESSION['reviewId']);
                echo "Review been deleted: " . $reviewBeenDeleted['reviewText'] . "<br>";
                echo "Review Date: " . $reviewBeenDeleted['reviewDate'] . "<br>";
                ?>
                <br><br>
                <input type="hidden" name="action" value="confirm-deletion">
                <input class="button-edit" role="button-edit" type="submit" value="Confirm Delete"><br><br>
            </form>
        </div>

        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</div>