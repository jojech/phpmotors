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
                <h1>User Registration</h1>
                <div id="registration">

                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form method="post" action="/phpmotors/accounts/index.php">
                    <fieldset class="form">
                        <legend>Join our network!</legend>
                        <label for="clientFirstname">First Name*</label>
                        <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                        <label for="clientLastname">Last Name*</label>
                        <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
                        <label for="clientEmail">Email*</label>
                        <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                        <label for="clientPassword">Password*</label>
                        <br><span>Must have at least 1 uppercase, 1 number, 1 special character, and 8 total characters</span>
                        <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                        <!--<label for="comment">Tell us about yourself! (1 sentence)</label>
                        <input name="comment" id="comment" type="text" placeholder="I love cars!!"><br>-->
                        <input type="submit" name="submit" id="regbtn" value="Sign up!">
                        <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="register">
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