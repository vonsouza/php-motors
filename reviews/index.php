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
        // echo 'add-review: add a new review';
        // Filter and store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reviewDate = date('Y-m-d H:i:s');
        
        $regOutcome = addReview($reviewText, $reviewDate, $invId, $_SESSION ['clientData']['clientId']);


        //working here
        //$reviewData = getReviewsFromInvId($invId);
        
        // the array_pop function removes the last
        // element from an array
        //array_pop($reviewData);
        // Store the array into the session
        
        //$_SESSION['reviewData'] = $reviewData;

        // Check and report the result
        if ($regOutcome === 1) {
            // $message = "<p>Thanks for registering $invMake.</p>";
            //$_SESSION['message'] = "Thanks for registering your review.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/success-review.php';
            exit;
        } else {
            // $message = "<p>Sorry!! the registration for $invMake failed. Please try again.</p>";
            //$_SESSION['message'] = "Sorry!! your review failed. Please try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/failed-review.php';
            exit;
        }

        break;

    case 'edit':
        echo 'Deliver a view to edit a review.';
        break;

    case 'update':
        echo 'Handle the review update';
        break;

    case 'confirm':
        echo 'Deliver a view to confirm deletion of a review.';
        break;

    case 'delete':
        echo 'Handle the review deletion.';
        break;

    default:
        echo 'A default that will deliver the "admin" view if the client is logged in or the php motors home view if not';
        break;  
}
