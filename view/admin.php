<?php
$classificationList = '<select name="classificationId" id="classificationList">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/view/home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<div class="main-card">
    <?php
    require_once '../model/reviews-model.php';
    require_once '../model/accounts-model.php';
    require_once '../model/vehicles-model.php';
    ?>
    <?php
    // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header-login.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';
    ?>

    <div class="internal-card">
        <div class="messageSuccessOrError">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
        </div>

        <h1>
            Logged in as
            <?php
            echo $_SESSION['clientData']['clientFirstname'] . ' ';
            echo $_SESSION['clientData']['clientLastname'];
            ?>
        </h1>

        <span> You are logged in. </span>

        <ul>
            <li>First name:
                <?php
                echo $_SESSION['clientData']['clientFirstname'];
                ?>
            </li>
            <li>Last name:
                <?php
                echo $_SESSION['clientData']['clientLastname'];
                ?>
            </li>
            <li>Email:
                <?php
                echo $_SESSION['clientData']['clientEmail'];
                ?>
            </li>
        </ul>

        <?php
        echo '<h2> Account Management </h2>';
        echo '<span> Use this link to manage account information. </span> <br><br>';
        echo '<a href="/phpmotors/accounts/index.php?action=updateAccountInformation" title="Update Account Information" id="updateAccountInformation">Update Account Information</a>';
        ?>

        <?php
        if ($_SESSION['clientData']['clientLevel'] == 2 || $_SESSION['clientData']['clientLevel'] == 3) {
            echo '<h2> Inventory Management </h2>';
            echo '<span> Use this link to manage the inventory. </span> <br><br>';
            echo '<a href="/phpmotors/vehicles/index.php?action=vehicleManagement" title="Vehicle Management with PHP Motors" id="vehicle-Management">Vehicle Management</a>';
        }
        ?>
        <br><br>
        <!-- Manage the User Product Reviews  -->

        <h2> Manage your Product Reviews </h2>
        <div class="manage-card">
            <?php $reviewsFromThisUser = getReviewsByClientId($_SESSION['clientData']['clientId']);
            if ($reviewsFromThisUser) {
                //echo ' existe review from your user...';
                foreach ($reviewsFromThisUser as $review) {
                    $vehicleReview = getVehicleByInvId($review['invId']);

                    echo "Review about the car: " . $vehicleReview['invMake'] . ' ' . $vehicleReview['invModel'] . "<br>";
                    echo "Review Date: " . $review['reviewDate'] . "<br>";
                    echo "Review text: " . $review['reviewText'] . "<br>";

                    $reviewId = $review['reviewId']; ?>

                    <a href="/phpmotors/reviews/index.php?action=edit&reviewId=<?php echo $review['reviewId'] ?>" title="edit Review" >Edit</a>
                    <span> | </span>
                    <a href="/phpmotors/reviews/index.php?action=delete&reviewId=<?php echo $review['reviewId'] ?>" title="delete Review" > Delete</a> <br>
                    <br>
            <?php }
            } else {
                echo $_SESSION['clientData']['clientFirstname'] . ' ';
                echo $_SESSION['clientData']['clientLastname'] . ' ';
                echo ' does not have review.';
            } ?>
        </div>
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