<?php

//==========================================================
// REVIEWS MODEL
//==========================================================


//----------------------------------------------------
// This function handles inserting new reviews
//----------------------------------------------------
function insertReview($reviewText, $invId, $clientId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'INSERT INTO reviews (reviewText,invId,clientId)
        VALUES (:reviewText,:invId,:clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//-------------------------------------------------------
// Get Reviews by Inventory Item
//-------------------------------------------------------
function getReviewsByInventoryId($invId){ 
    $db = phpmotorsConnect(); 
    $sql = 'SELECT r.reviewText, r.reviewDate, c.clientFirstname
            , c.clientLastname
            FROM reviews r
            INNER JOIN clients c
            ON r.clientId = c.clientId
            WHERE r.invId = :invId
            ORDER BY r.reviewDate'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
}

//-------------------------------------------------------
// Get Reviews by Client
//-------------------------------------------------------
function getReviewsByClientId($clientId){ 
    $db = phpmotorsConnect(); 
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, i.invMake
            , i.invModel
            FROM reviews r
            INNER JOIN inventory i
            ON r.invId = i.invId
            WHERE r.clientId = :clientId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
}

//----------------------------------
// Get review information by reviewId
//----------------------------------
function getReviewById($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewText, reviewDate,
            clientId, invId
            FROM reviews
            WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $revInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revInfo;
}

//---------------------------------
// Update Review
//---------------------------------
function updateReview(
    $reviewId,$reviewText,$reviewDate,$invId,$clientId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'UPDATE reviews
                SET reviewText = :reviewText
                , reviewDate = :reviewDate
                , invId = :invId
                , clientId = :clientId
                WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//--------------------------------
// Delete Review
//--------------------------------
function deleteReview($reviewId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'DELETE FROM reviews
                WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
?>