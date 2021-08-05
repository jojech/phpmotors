<?php

//=======================================================
// ACCOUNTS CONTROLLER
//=======================================================

// Create or access Session
if (!isset($_SESSION)) {
    session_start();
}
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts-model.php file
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

// Get the array of classifications and build Navigation
$classifications = getClassifications();
$navList = navBuilder($classifications);



$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
switch ($action){
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        // Validate email and password
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        // Checking for existing email address
        $emailChecker = duplicateEmailChecker($clientEmail);
        if ($emailChecker) {
            $message = '<p>Email already exists. Please login instead.</p>';
            include '../view/login.php';
            break;
        }
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
           $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        // Use hashed password in INSERT statement
        $regOutcome = regClient($clientFirstname,$clientLastname,$clientEmail,$hashedPassword);
        if ($regOutcome === 1) {
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            setcookie('firstname',$clientFirstname,strtotime('+ 1 year'),'/');
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        // Retrieve variables used to login
        $clientEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        // Validate email and password
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        // Check if either of the values are empty (or invalid)
        if (empty($clientEmail) || empty($clientPassword)) {
           $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        } 
        elseif (empty($checkPassword)) {
            $message = '<p>Password invalid.</p>';
            include '../view/login.php';
            exit;
        } 
        else {
            $message = null;
        }
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
        $clientReviewsDisplay = buildReviewsDisplayClientAdmin($reviews);
        include '../view/admin.php';
        break;
    case 'Logout':
        $_SESSION['loggedin'] = FALSE;
        session_unset();
        session_destroy();
        header('Location: /phpmotors/');
        break;
    case 'update':
        $clientId = $_SESSION['clientData']['clientId'];
        if (empty($clientId)) {
            include '../view/500.php';
        }
        $clientInfo = getClientById($clientId);
        if (count($clientInfo)<1) {
            $message = '<p>Sorry no data found</p>';
        }
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
        // Validate email
        $clientEmail = checkEmail($clientEmail);
        // Checking for existing email address
        $emailChecker = duplicateEmailChecker($clientEmail);
        if ($emailChecker) {
            $message = '<p>Email already exists. Please use a different email.</p>';
            include '../view/client-update.php';
            break;
        }
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
           $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }
        // Send the data to the model
        $updateResult = updateClient($clientFirstname,$clientLastname,$clientEmail,$clientId);
        if ($updateResult) {
            $message = "$clientFirstname, your account has been successfully updated.";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, account failed to update.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'updatePassword':
        // Filter and store the data
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);
        // Check for missing data
        if (empty($checkPassword)) {
           $message = '<p>Invalid Password.</p>';
            include '../view/client-update.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        // Use hashed password in INSERT statement
        $updatePasswordResult = updatePassword($hashedPassword,$clientId);
        if ($updatePasswordResult === 1) {
            $_SESSION['message'] = "Password succesfully changed!";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        // Maintain stickiness
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        break;
    default:
        if ($_SESSION['loggedin']) {
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            $clientReviewsDisplay = buildReviewsDisplayClientAdmin($reviews);
        }
        include '../view/admin.php';
        break;
}

?>