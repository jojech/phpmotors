<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($vehicle['invMake']) && isset($vehicle['invModel'])) {
            echo "$vehicle[invMake] $vehicle[invModel]";} ?> | PHP Motors, Inc.</title>
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
                <h1><?php if(isset($vehicle['invMake']) && isset($vehicle['invModel'])) {
                    echo "$vehicle[invMake] $vehicle[invModel]";} ?></h1>
                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <div id="vdetailbox">
                <?php
                    if (isset($vehicleDisplay)) {
                        echo $vehicleDisplay;
                    }
                ?></div>
                <div id="rdetailbox">
                    <h4>Customer Reviews</h4>
                    <?php
                        if (isset($_SESSION['loggedin'])) {
                            echo $submitReviewForm;
                        } else {
                            echo '<a href="/phpmotors/accounts/index.php?action=login" title="Log in" class="logButton">Log in to add your review</a>';
                        }
                        if (isset($reviewDisplay)) {
                            echo $reviewDisplay;
                        }
                    ?>
                </div>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>