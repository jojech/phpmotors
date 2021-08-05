<?php 
    if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
    }
    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
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
                <h1>Vehicle Management</h1>
                <div class="form">
                <form method="post" action="/phpmotors/vehicles/index.php">  
                    <fieldset>
                        <legend>Would you like to add a Vehicle or Classification?</legend>
                        <input type="submit" name="action" id="addVbtn" value="vehicle">
                        <input type="submit" name="action" id="addCbtn" value="classification">
                    </fieldset>
                </form>
                </div>
                <?php if (isset($message)) {
                    echo $message;
                }
                if (isset($classificationList)) {
                    echo '<h2>Vehicles by Classification</h2>';
                    echo '<p>Choose a classification to see those vehicles</p>'; 
                    echo $classificationList;
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    <script src="../js/inventory.js"></script>
    </body>
</html><?php unset($_SESSION['message']); ?>