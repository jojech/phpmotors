<?php 
    if (!isset($_SESSION['loggedin'])) {
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
                <h1>Logged in as 
                    <?php
                        echo $_SESSION['clientData']['clientFirstname'],' ',$_SESSION['clientData']['clientLastname'];
                    ?>
                </h1>
                <?php if(isset($_SESSION['message'])) { echo $_SESSION['message'];} ?>
                <ul>
                    <li>First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
                    <li>Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                    <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
                </ul>
                <p><a href="/phpmotors/accounts?action=update">Update Account Information</a></p>
                <?php
                    if ($_SESSION['clientData']['clientLevel'] > 1) {
                        echo '<h3>Administer Inventory</h3>';
                        echo '<p>View the <a href="/phpmotors/vehicles?action=update">Vehicle Management Page</a></p>';
                    }
                    // Get Client Reviews
                    if (isset($clientReviewsDisplay)) {
                        echo $clientReviewsDisplay;
                    }
                ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>