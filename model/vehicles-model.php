<?php
//================================================
// THE VEHICLES MODEL
//================================================

//----------------------------------------------------
// This function handles inserting new classifications
//----------------------------------------------------
function addClassification($classificationName) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//--------------------------------------
// Function handling inserting a new vehicle into the inventory table
//--------------------------------------
function addVehicle(
    $invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice
    ,$invStock,$invColor,$classificationId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'INSERT INTO inventory (
        invMake
        , invModel
        , invDescription
        , invImage
        , invThumbnail
        , invPrice
        , invStock
        , invColor
        , classificationId)
        VALUES (
            :invMake
            , :invModel
            , :invDescription
            , :invImage
            , :invThumbnail
            , :invPrice
            , :invStock
            , :invColor
            , :classificationId);';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//----------------------------------
// Get vehicles by classificationID
//----------------------------------
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

//------------------------------------
// Get vehicles by classificationName
//------------------------------------
function getVehiclesByClassification($classificationName){ 
    $db = phpmotorsConnect(); 
    $sql = 'SELECT i.invId, i.invMake, i.invModel
            , i.invDescription
            , img.imgPath
            , i.invPrice, i.invStock, i.invColor
            , i.classificationId 
            FROM inventory i
            INNER JOIN images img
            ON img.invId = i.invId
            WHERE classificationId IN 
            (SELECT classificationId 
            FROM carclassification 
            WHERE classificationName = :classificationName)
            AND img.imgPrimary = 1
            AND img.imgPath LIKE "%-tn%"'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

//----------------------------------
// Get vehicle information by invId
//----------------------------------
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT i.invId, i.invMake, i.invModel
            , i.invDescription
            , img.imgPath
            , i.invPrice, i.invStock, i.invColor
            , i.classificationId 
            FROM inventory i
            INNER JOIN images img
            ON img.invId = i.invId
            WHERE i.invId = :invId
            AND img.imgPrimary = 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//---------------------------------
// Update Vehicle in Inventory
//---------------------------------
function updateVehicle(
    $invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice
    ,$invStock,$invColor,$classificationId,$invId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'UPDATE inventory
                SET invMake = :invMake
                , invModel = :invModel
                , invDescription = :invDescription
                , invImage = :invImage
                , invThumbnail = :invThumbnail
                , invPrice = :invPrice
                , invStock = :invStock
                , invColor = :invColor
                , classificationId = :classificationId
                WHERE invId = :invId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
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
// Delete Vehicle out of inventory
//--------------------------------
function deleteVehicle($invId) {
    // Connect to database
    $db = phpmotorsConnect();
    // Create SQL statement
    $sql = 'DELETE FROM inventory
                WHERE invId = :invId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
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

//----------------------------------
// Get information for all vehicles
//----------------------------------
function getVehicles() {
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

?>