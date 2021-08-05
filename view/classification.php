<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
                <h1><?php echo $classificationName; ?></h1>
                <?php if(isset($message)) {
                    echo $message; }
                    if (isset($vehicleDisplay)) {
                        echo $vehicleDisplay;}
                ?>
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>