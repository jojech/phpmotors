<?php 
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
                <h1>Add Classification</h1>
                <?php if (isset($message)) {echo $message;} ?>
                <div class="form">
                <form method="post" action="/phpmotors/vehicles/index.php">
                    <fieldset class="form">
                        <legend>Add New Vehicle Classification</legend>
                        <label for="classificationName">Classification Name*</label>
                        <input name="classificationName" id="classificationName" type="text" required><br>
                        <input type="submit" name="submit" id="addCbtn" value="Add Classification!">
                        <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="classification">
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