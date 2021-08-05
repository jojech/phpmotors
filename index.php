<?php

// Create or access a session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications and build Navigation
$classifications = getClassifications();
$navList = navBuilder($classifications);

if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE,'firstname',FILTER_SANITIZE_STRING);
}

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
switch ($action){
    case 'something':
        break;
    default:
        include 'view/home.php';
}

?>