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
                <h1>User Login</h1>
                <div id="login">

                <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form method="post" action="/phpmotors/accounts/">
                    <fieldset class="form">
                        <legend>Sign in to your account</legend>
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                        <br>
                        <label for="password">Password</label>
                        <br><span>All passwords have 8+ characters, at least 1 uppercase, number, and special character.</span>
                        <input name="password" id="password" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <br>
                        <input type="submit" id="submit" value="Login">
                        <input type="hidden" name="action" value="Login">
                        <br>
                        <p>Don't have an account? <a href='/phpmotors/accounts/index.php?action=register' title="Register new user">Create one now</a></p>
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