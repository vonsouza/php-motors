<div id="wrapper">
    <header>
        <div id="top-header">
            <img class="logo-image" src="/phpmotors/images/site/logo.png" alt="Logo PHP motors">
            <?php
                // Check if the firstname cookie exists, get its value
                if (isset($_SESSION['loggedin']) && isset($_COOKIE['firstname'])) {
                    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    // echo "<span class='my-account'>" . $cookieFirstname . '<a class="no-decoration" href="/phpmotors/accounts/index.php?action=home" title="Vehicle Management with PHP Motors" id="vehicleManagement"> | Logout </a> </span>';
                    //mudando home to loggout
                    echo "<span class='my-account'>" . $cookieFirstname . '<a class="no-decoration" href="/phpmotors/accounts/index.php?action=logout" title="Vehicle Management with PHP Motors" id="vehicleManagement"> | Logout </a> </span>';
                   
                }else{
                    echo '<span class="my-account"><a href="/phpmotors/accounts/index.php?action=login" title="Login or Register with PHP Motors" id="acc">My Account</a></span>';
                }

                
                
                // if (isset($_SESSION['loggedin'])) {
                //     echo "<span class='my-account'>" . $cookieFirstname . '<a class="no-decoration" href="/phpmotors/accounts/index.php?action=home" title="Vehicle Management with PHP Motors" id="vehicleManagement"> | Logout </a> </span>';
                
                // }else{
                //     echo '<a class="my-account" href="/phpmotors/accounts/index.php?action=login" title="Login or Register with PHP Motors" id="acc">My Account</a></span>';
                // }
            ?>
            <!-- <a class="my-account" href="/phpmotors/accounts/index.php?action=login" title="Login or Register with PHP Motors" id="acc">My Account </a> -->
        </div>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
</div>