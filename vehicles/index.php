<?php

//=======================================================
// VEHICLES CONTROLLER
//=======================================================

// Create or access session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../model/accounts-model.php';
// Get the vehicles-model.php file
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../model/uploads-model.php';

// Get the array of classifications and build Navigation
$classifications = getClassifications();
$navList = navBuilder($classifications);

$action = filter_input(INPUT_POST,'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
switch($action){
    case 'getInventoryItems':
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'vehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST,'invMake',FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST,'invModel',FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST,'invDescription',FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST,'invImage',FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST,'invThumbnail',FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST,'invPrice',FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST,'invStock',FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST,'invColor',FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST,'carclassification',FILTER_SANITIZE_NUMBER_INT);
        if (empty($invMake)
            || empty($invModel)
            || empty($invDescription)
            || empty($invImage)
            || empty($invThumbnail)
            || empty($invPrice)
            || empty($invStock)
            || empty($invColor)
            || empty($classificationId)) {
                $message = '<p>Please provide information for each data field</p>';
                include '../view/add-vehicle.php';
                exit;
            }
        $vehicleAddOutcome = addVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId);
        if ($vehicleAddOutcome === 1) {
            $message = '<p>Successfully added vehicle to inventory!</p>';
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = '<p>Sorry, vehicle failed to be added.</p>';
            include '../view/add-vehicle.php';
            exit;
        }
        include '../view/add-vehicle.php';
        break;
    case 'classification':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST,'classificationName');
        // Check if data is empty
        if (empty($classificationName)) {
            $message = '<p>Please provide a Classification Name</p>';
            include '../view/add-classification.php';
            exit;
        }
        // Store Outcome variable
        $classAddOutcome = addClassification($classificationName);
        // If insert successful, go to vehicle management page
        if ($classAddOutcome === 1) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = '<p>Sorry, system failure.</p>';
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        // Filter and store the data
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST,'invMake',FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST,'invModel',FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST,'invDescription',FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST,'invImage',FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST,'invThumbnail',FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST,'invPrice',FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST,'invStock',FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST,'invColor',FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST,'carclassification',FILTER_SANITIZE_NUMBER_INT);
        if (empty($invMake)
            || empty($invModel)
            || empty($invDescription)
            || empty($invImage)
            || empty($invThumbnail)
            || empty($invPrice)
            || empty($invStock)
            || empty($invColor)
            || empty($classificationId)) {
                $message = '<p>Please provide information for each data field</p>';
                include '../view/vehicle-update.php';
                exit;
            }
        $updateResult = updateVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId,$invId);
        if ($updateResult) {
            $message = "<p>Successfully updated $invMake $invModel in inventory!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = '<p>Sorry, vehicle failed to be updated.</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        include '../view/vehicle-update.php';
        break;
    case 'del':
        $invId = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        // Filter and store the data
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST,'invMake',FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST,'invModel',FILTER_SANITIZE_STRING);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p>Successfully deleted $invMake $invModel out of inventory.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Failed to delete $invMake $invModel out of inventory.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        include '../view/vehicle-update.php';
        break;
    case 'Classification':
        $classificationName = filter_input(INPUT_GET,'classificationName',FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'cardisplay':
        $invId = filter_input(INPUT_GET,'invId',FILTER_SANITIZE_NUMBER_INT);
        $vehicle = getInvItemInfo($invId);
        if (empty($vehicle)) {
            $message = "<p>Sorry, no vehicle found.</p>";
        } else {
            $vehicleDisplay = buildVehicleDisplay($vehicle);
            $vehicleDisplay .= thumbnailBuildVehicleDisplay(getThumbnailPaths($invId));
            $reviews = getReviewsByInventoryId($invId);
            if (count($reviews)<1) {
                $reviewDisplay = "<p>No reviews for this vehicle yet!</p>";
            } else {
                $reviewDisplay = buildReviewsDisplayVehicleDetail($reviews);
            }
            if (isset($_SESSION['loggedin'])) {
                $clientInfo = getClientById($_SESSION['clientData']['clientId']);
                $submitReviewForm = buildReviewSubmitForm($invId,$clientInfo);
            }
        }
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-management.php';
        break;
}

?>