<?php

/************
    Image Reviews Controller
 ***********/

//  1. Add a new review
//  2. Deliver a view to edit a review.
//  3. Handle the review update.
//  4. Deliver a view to confirm deletion of a review.
//  5. Handle the review deletion.
//  6. A default that will deliver the "admin" view if the client is logged in or the
//  php motors home view if not.

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigationBar($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}



switch ($action) {
    case 'add-review':
        unset($_SESSION['message']);
        // echo 'add-review: add a new review';
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reviewDate = date('Y-m-d H:i:s');

        if (empty($reviewText)) {
            $_SESSION['message'] = "The review is empty, please type your review and try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            exit;
        }
        
        $regOutcome = addReview($reviewText, $reviewDate, $invId, $_SESSION ['clientData']['clientId']);

        // Check and report the result
        if ($regOutcome === 1) {
            $_SESSION['message'] = "Your review was added successfully!";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            exit;
        } else {
            $_SESSION['message'] = "Sorry. Your review was not added. Please try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
            exit;
        }
        break;

    case 'edit':
        unset($_SESSION['message']);
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['reviewId'] = $reviewId;

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-edit.php';
        exit;

    case 'update-review':
        unset($_SESSION['message']);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $regOutcome = updateReviewText($_SESSION['reviewId'], $reviewText);

        $_SESSION['message'] = "Your review was updated to: $reviewText";
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        break;

    case 'confirm-deletion':
        unset($_SESSION['message']);
        $regOutcome = deleteReviewId($_SESSION['reviewId']) ;
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-confirm-delete.php';
        break;

    case 'delete':
        unset($_SESSION['message']);
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['reviewId'] = $reviewId;
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-delete.php';
        break;

    default:
        unset($_SESSION['message']);
        //A default that will deliver the "admin" view if the client is logged in or the php motors home view if not
        if (isset($_SESSION['loggedin'])) {
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        }else{
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
        }
        break;  
}
