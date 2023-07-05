<?php

/********
 * Main Controller
 ***********/

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = buildNavigationBar($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case 'something':

        break;
    case 'template':
        //add ?action=template
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/template.php';
        break;
    default:
        //include 'view/home.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
}
