<?php
// $classifications is the array from the database
$classifications = getClassifications();
// Build drop down list with car classifications
// $classificationList is a unique variable to this page -> called later in the page to echo the select
// the carclassification element comes from the input on the page
$classificationList = "<select id='carclassification' name='carclassification' required>";
// $classification -> unique variable to go through the foreach loop
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    // $classificationId is created in the controller
    if (isset($classificationId)) {
        if ($classificationId === $classification['classificationId']) {
            $classificationList .= " selected";
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>'; 
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motor | CSE 340</title>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
    </head>
    <body>
        <div id="site_container">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
                <nav id="page_nav">
                    <?php echo $navList; ?>
                </nav>
            </header>
            <main>
                <h1>Add Vehicle</h1>
                <?php if (isset($message)) {echo $message;} ?>
                <div class="form">
                <form method="post" action="/phpmotors/vehicles/index.php">
                    <fieldset class="form">
                        <legend>Add New Vehicle to Inventory</legend>
                        <label for="invMake">Make*</label>
                        <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required><br>
                        <label for="invModel">Model*</label>
                        <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required><br>
                        <label for="invDescription">Description</label>
                        <input name="invDescription" id="invDescription" type="text" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required><br>
                        <label for="invImage">Image</label>
                        <input name="invImage" id="invImage" type="text" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required><br>
                        <label for="invThumbnail">Thumbnail</label>
                        <input name="invThumbnail" id="invThumbnail" type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required><br>
                        <label for="invPrice">Price*</label>
                        <input name="invPrice" id="invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required><br>
                        <label for="invStock">Stock*</label>
                        <input name="invStock" id="invStock" type="number" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required><br>
                        <label for="invColor">Color*</label>
                        <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required><br>
                        <label for="carclassification">Classification*</label>
                        <?php 
                            echo $classificationList;
                        ?>
                        <input type="submit" name="submit" id="addVbtn" value="Add Vehicle!">
                        <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="vehicle">
                        <h6>*Required</h6>
                    </fieldset>
                </form>
                </div>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>