<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,200;1,100&display=swap" rel="stylesheet">
</head>

<div class="main-card">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

    <div class="internal-card">
        <div class="login-card">

            <h1>Register In</h1>

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

            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">First Name: </label>
                <input type="text" name="clientFirstname" id="clientFirstname" required <?php if (isset($clientFirstname)) {
                                                                                            echo "value='$clientFirstname'";
                                                                                        }  ?>><br><br>

                <label for="clientLastname">Last Name: </label>
                <input type="text" name="clientLastname" id="clientLastname" required <?php if (isset($clientLastname)) {
                                                                                            echo "value='$clientLastname'";
                                                                                        }  ?>><br><br>

                <label for="clientEmail">Email: </label>
                <input type="email" name="clientEmail" id="clientEmailReg" required <?php if (isset($clientEmail)) {
                                                                                        echo "value='$clientEmail'";
                                                                                    }  ?>><br><br>

                <span class="explan-password">The password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special caracter</span><br>
                <label for="clientPassword">Password: </label>
                <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="registerUser">
                <input class="button-edit" role="button-edit" type="submit" value="Register">

                <br><br>
            </form>

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