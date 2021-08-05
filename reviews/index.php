<?php

//===========================================================
// REVIEWS CONTROLLER
//===========================================================

if (!isset($_SESSION)) {
session_start();
}
include_once '../library/connections.php';
include_once '../library/functions.php';
include_once '../model/reviews-model.php';
include_once '../model/accounts-model.php';
include_once '../model/main-model.php';

$classifications = getClassifications();
$navList = navBuilder($classifications);

if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE,'firstname',FILTER_SANITIZE_STRING);
}

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action) {
    case 'submitReview':
        $clientId = filter_input(INPUT_POST,'clientId',FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST,'invId',FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST,'reviewText',FILTER_SANITIZE_STRING);
        if (empty($clientId)
            || empty($invId)
            || empty($reviewText)) {
                $message = '<p>Something went wrong</p>';
                include '../accounts/index.php';
                exit;
            }
        $insertResult = insertReview($reviewText,$invId,$clientId);
        if ($insertResult) {
            $message = "<p>Successfully added Review!</p>";
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        } else {
            $message = '<p>Sorry, review failed to be inserted.</p>';
            include '../accounts/index.php';
            exit;
        }
        include '../accounts/index.php';
        break;
    case 'editedReview':
        $reviewId = filter_input(INPUT_POST,'reviewId',FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST,'reviewText',FILTER_SANITIZE_STRING);
        if (empty($reviewId)) {
            $message = '<p>Something went wrong with the review Id</p>';
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        }
        if (empty($reviewText)) {
            $message = '<p>Something went wrong with the review</p>';
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        } 
        $oldReview = getReviewById($reviewId);
        $updateResult = updateReview($reviewId,$reviewText,$oldReview['reviewDate'],$oldReview['invId'],$oldReview['clientId']);
        if ($updateResult) {
            $message = "<p>Successfully updated Review!</p>";
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        } else {
            $message = '<p>Sorry, review failed to be updated.</p>';
            include '../accounts/index.php';
            exit;
        }
        include '../accounts/index.php';
        break;
    case 'editReview':
        $reviewId = filter_input(INPUT_GET,'reviewId',FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewId)) {
            include '../view/500.php';
        }
        $review = getReviewById($reviewId);
        if (count($review)<1) {
            $message = '<p>Sorry no data found</p>';
        }
        $reviewText = $review['reviewText'];
        include '../view/review-update.php';
        break;
    case 'deleteReview':
        $reviewId = filter_input(INPUT_GET,'reviewId',FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewId)) {
            include '../view/500.php';
        }
        $review = getReviewById($reviewId);
        if (count($review)<1) {
            $message = '<p>Sorry no data found</p>';
        }
        $reviewText = $review['reviewText'];
        include '../view/review-delete.php';
        break;
    case 'deletedReview':
        $reviewId = filter_input(INPUT_POST,'reviewId',FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewId)) {
            $message = '<p>Something went wrong with the review Id</p>';
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        }
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p>Successfully deleted Review!</p>";
            $_SESSION['message'] = $message;
            include '../accounts/index.php';
            exit;
        } else {
            $message = '<p>Sorry, review failed to be deleted.</p>';
            include '../accounts/index.php';
            exit;
        }
        include '../accounts/index.php';
        break;
    default:
        include '../accounts/index.php';
        break;
}

?>