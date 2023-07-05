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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Vehicle</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<div class="main-card">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    <div class="internal-card">

        <h1>Add Vehicle</h1>

        <div class="messageSuccessOrError">
            <?php
            // if (isset($message)) {
            //     echo $message;
            // }
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
        </div>

        <span class="explan-password">*Note all Fields are required</span><br>

        <form method="post" action="/phpmotors/vehicles/index.php">

            <label for="carClass">Classification </label><br>

            <select name="classificationId" id="classificationList">
                <option>Choose a Classification</option>
                <?php foreach ($classifications as $classification) { ?>
                    <option value="<?php echo $classification['classificationId'] ?>" <?php if (isset($classificationId) && $classificationId == $classification['classificationId']) {
                                                                                            echo " selected ";
                                                                                        } ?>>
                        <?php echo $classification['classificationName'] ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="invMake">Make </label><br>
            <input type="text" name="invMake" id="invMake" <?php if (isset($invMake)) {
                                                                echo "value='$invMake'";
                                                            } ?> required><br><br>

            <label for="invModel">Model </label><br>
            <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)) {
                                                                    echo "value='$invModel'";
                                                                } ?> required><br><br>

            <label for="invDescription">Description </label><br>
            <textarea name="invDescription" id="invDescription" <?php if (isset($invDescription)) {
                                                                    echo "value='$invDescription'";
                                                                } ?> required> </textarea><br><br>

            <label for="invImage">Image Path </label><br>
            <input type="text" name="invImage" id="invImage" <?php if (isset($invImage)) {
                                                                    echo "value='$invImage'";
                                                                } ?> required><br><br>

            <label for="invThumbnail">Thumbnail Path </label><br>
            <input type="text" name="invThumbnail" id="invThumbnail" <?php if (isset($invThumbnail)) {
                                                                            echo "value='$invThumbnail'";
                                                                        } ?> required><br><br>

            <span class="explan-password">Price only allows numbers (int or float)</span><br>
            <label for="invPrice">Price </label><br>
            <input type="number" name="invPrice" id="invPrice" pattern="[+-]?\d+(\.\d+)?" <?php if (isset($invPrice)) {
                                                                                                echo "value='$invPrice'";
                                                                                            } ?> required><br><br>

            <label for="invStock">Stock </label><br>
            <input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {
                                                                    echo "value='$invStock'";
                                                                } ?> required><br><br>

            <label for="invColor">Color </label><br>
            <input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {
                                                                    echo "value='$invColor'";
                                                                } ?> required><br><br>

            <!-- Add the action name - value pair -->
            <input type="submit" name="submit" value="Add Vehicle">
            <input type="hidden" name="action" value="registerVehicle">

            <br><br>
        </form>

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