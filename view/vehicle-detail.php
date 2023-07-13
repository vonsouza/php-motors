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
    <?php 
        require_once '../model/reviews-model.php';
        require_once '../model/accounts-model.php';
    ?>
    
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

        <!-- Custumer Reviews -->
        
        <?php
            if (isset($_SESSION['loggedin']) && isset($_COOKIE['firstname'])) { ?>
                <?php echo "<span class='no-decoration'>" . $_SESSION ['clientData']['clientFirstname'] . ' ' . $_SESSION ['clientData']['clientLastname'] . ' ' . ' write your review</a> </span>';  ?>

                <div class="login-card">     
                    <!-- First name only the first letter capital. Last name with first letter capital -->
                    <?php  
                        $firstName =  $_SESSION ['clientData']['clientFirstname'];
                        $lastName =  $_SESSION ['clientData']['clientLastname'];

                        // Get the first letter of the first name
                        $firstNameInitial = strtoupper(substr($firstName, 0, 1));
                        
                        // Remove spaces from the last name and capitalize the first letter
                        $lastName = str_replace(' ', '', ucwords(strtolower($lastName)));

                        // Concatenate the modified first name and last name
                        $fullName = $firstNameInitial . $lastName;

                    ?>
        
                    <form method="post" action="/phpmotors/reviews/index.php">
                        <label for="screenname">Screen Name:</label> <br>
                        <input type="text" id="screenname" name="screenname" value="<?php echo $fullName; ?>" readonly><br><br>

                        <label for="reviewText">Review:</label><br>
                        <textarea id="reviewText" name="reviewText" rows="5" cols="30" required></textarea><br><br>

                        <input type="hidden" name="action" value="add-review">
                        <input type="hidden" name="invId" value=" <?php echo $_SESSION['invDetail'][0]['invId']; ?> ">
                        <input type="hidden" name="clientId" value=" <?php echo $_SESSION['invDetail'][1]['clientId']; ?> ">

                        <input class="button-edit" role="button-edit" type="submit" value="Submit Review"><br><br>
                    </form>
        
                </div>
                <?php }else{ ?>
                    <?php echo '<span> You must <a href="/phpmotors/accounts/index.php?action=login" title="Login or Register with PHP Motors" id="acc">login</a> to write a review.</span>'; ?>
            <?php } ?>
            <br><br>
        <!-- Previous Custumer Reviews -->
        <div class="review-card">
                <h3><span class="underlined"><?php echo 'Custumer Reviews to ' . $_SESSION['invDetail'][0]['invMake'] . ' ' . $_SESSION['invDetail'][0]['invModel']; ?> </span></h3>
                <br><br>
                <tr></tr>                
                <!-- print reviews -->
                <?php $reviewsFromThisCar = getReviewsFromInvId($_SESSION['invDetail'][0]['invId']); 

                    //Getting the name having just the ClientId
                    $_SESSION['reviewData'] = $reviewsFromThisCar;

                    // Call the function and get the result
                    $reviews = getReviewsFromInvId($invId);
                ?>
                
                <!--  -->

                <?php
                if ($reviewsFromThisCar) {

                    // Loop through the result and echo the desired values
                    foreach ($reviews as $review) {
                        $whowrote = getClientById($review['clientId']);
                        $firstName =  $whowrote['clientFirstname'] ;
                        $lastName =  $whowrote['clientLastname'] ;

                        // Get the first letter of the first name
                        $firstNameInitial = strtoupper(substr($firstName, 0, 1));
                        
                        // Remove spaces from the last name and capitalize the first letter
                        $lastName = str_replace(' ', '', ucwords(strtolower($lastName)));

                        // Concatenate the modified first name and last name
                        $fullName = $firstNameInitial . $lastName;


                        echo $fullName . " wrote in " . $review['reviewDate'] . ": <br>";
                        //echo "Review ID: " . $review['reviewId'] . "<br>";
                        echo $review['reviewText'] . "<br>";
                        //echo "Review Date: " . $review['reviewDate'] . "<br>";
                        //echo "Inventory ID: " . $review['invId'] . "<br>";
                        //echo "Client ID: " . $review['clientId'] . "<br>";
                        
                        //echo "Wrote by : " . $whowrote['clientFirstname'] . "<br>";
                        echo "<br>";
                    }
                    
                } else {
                    echo "Be the first to write a review ";
                }  ?>

                <br><br>
                <tr></tr>
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