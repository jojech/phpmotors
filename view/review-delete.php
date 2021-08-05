<!DOCTYPE html>
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
                <h1>Confirm Deletion of Your Review (Deletion is permanent)</h1>
                <div class="form">
                <form method="post" action="/phpmotors/reviews/index.php">
                    <fieldset class="form">
                        <legend>What You Reported:</legend>
                        <input readonly name="reviewText" id="reviewText" type="text" <?php if(isset($reviewText)){echo "value='$reviewText'";} elseif(isset($review['reviewText'])) {echo "value='$review[reviewText]'";}  ?> required><br>
                        <input type="submit" name="submit" id="deleteRbtn" value="Delete Review">
                        <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="deletedReview">
                            <input type="hidden" name="reviewId" value="
                                <?php if(isset($reviewId)){echo $reviewId;} ?>">
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