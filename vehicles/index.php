<?php
/***********
    Vehicles Controller
**********/

// Create or access a Session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
//Get the accounts model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
$navList = buildNavigationBar($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'addClassification':
        unset($_SESSION['message']);
        // echo 'You are in the addClassification case statement.';

        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check for missing data
        if (empty($classificationName)) {
            // $message = '<p>Please provide information for the empty form field.</p>';
            $_SESSION['message'] = "Please provide information for the empty form field.";
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = regClassification($classificationName);

        // Check and report the result
        if ($regOutcome === 1) {
            // $message = "<p>Thanks for registering $classificationName.</p>";
            $_SESSION['message'] = "Thanks for registering $classificationName.";
            include '../view/add-classification.php';
            exit;
        } else {
            // $message = "<p>Sorry the registration for $classificationName failed. Please try again.</p>";
            $_SESSION['message'] = "Sorry the registration for $classificationName failed. Please try again.";
            include '../view/add-classification.php';
            exit;
        }

        break;

    case 'registerVehicle':
        unset($_SESSION['message']);
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if (
            empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) ||
            empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) ||
            empty($classificationId)
        ) {
            // $message = '<p>Please provide information for the empty form field.</p>';
            $_SESSION['message'] = "Please provide information for the empty form field.";
            include '../view/add-vehicle.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if ($regOutcome === 1) {
            // $message = "<p>Thanks for registering $invMake.</p>";
            $_SESSION['message'] = "Thanks for registering $invMake.";
            include '../view/add-vehicle.php';
            exit;
        } else {
            // $message = "<p>Sorry!! the registration for $invMake failed. Please try again.</p>";
            $_SESSION['message'] = "Sorry!! the registration for $invMake failed. Please try again.";
            include '../view/add-vehicle.php';
            exit;
        }
        break;

    case 'vehicleManagement':
        unset($_SESSION['message']);
        //add ?action=vehicleManagement
        $_SESSION['loggedin'] = TRUE;
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        break;

    case 'add-classification':
        unset($_SESSION['message']);
        //add ?action=add-classification
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;
    case 'add-vehicle':
        unset($_SESSION['message']);
        //add ?action=add-vehicle
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
        break;

    case 'classification':
        unset($_SESSION['message']);
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
            $_SESSION['message'] = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $page_title = $classificationName;
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php';
        break;

    case 'vehicleDetail':
        unset($_SESSION['message']);
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

        //Getting vehicle informations
        $invDetail = getInvDetails($invId);
        $invThumbnails= getThumbnailImages($invId);

        // Store the array into the session
        $_SESSION['invDetail'] = $invDetail;
        $_SESSION['invThumbnails'] = $invThumbnails;

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
        break;

    default:
    unset($_SESSION['message']);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        break;
}
