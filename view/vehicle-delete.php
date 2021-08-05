<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php 
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } elseif(isset($invMake) && isset($invModel)) {
                echo "Delete $invMake $invModel";
            }
        ?> | PHP Motors</title>
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
                <h1><?php 
                    if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                        echo "Delete $invInfo[invMake] $invInfo[invModel]";
                    } elseif(isset($invMake) && isset($invModel)) {
                        echo "Delete $invMake $invModel";
                    }
                ?></h1>
                <?php if (isset($message)) {echo $message;} ?>
                <div class="form">
                <form method="post" action="/phpmotors/vehicles/index.php">
                    <fieldset class="form">
                        <legend>Confirm Vehicle Deletion. The delete is permanent.</legend>
                        <label for="invMake">Make*</label>
                        <input readonly name="invMake" id="invMake" type="text" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";}  ?>><br>
                        <label for="invModel">Model*</label>
                        <input readonly name="invModel" id="invModel" type="text" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";}   ?>><br>
                        <label for="invDescription">Description</label>
                        <input readonly name="invDescription" id="invDescription" type="text" <?php if(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'";}   ?>><br>
                        <input type="submit" name="submit" id="deleteVbtn" value="Delete Vehicle">
                        <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="deleteVehicle">
                            <input type="hidden" name="invId" value="
                                <?php if(isset($invInfo['invId'])){
                                    echo $invInfo['invId'];}
                                ?>
                            ">
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