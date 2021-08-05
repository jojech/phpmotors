<?php
    if (!isset($_SESSION['loggedin'])) {
        header('location: /phpmotors/');
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
                <h1>Account Management</h1>
                <div id="login">
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        }
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                <!--Account Update-->
                <form method="post" action="/phpmotors/accounts/">
                    <fieldset class="form">
                        <legend>Update Account Information</legend>
                        <label for="clientFirstname">First Name</label>
                        <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($clientInfo['clientFirstname'])){ echo "value='$clientInfo[clientFirstname]'"; } elseif(isset($clientFirstname)){ echo "value='$clientFirstname'";} ?> required>
                        <label for="clientLastname">Last Name</label>
                        <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientInfo['clientLastname'])){ echo "value='$clientInfo[clientLastname]'"; } elseif(isset($clientLastname)){ echo "value='$clientLastname'";} ?> required>
                        <label for="clientEmail">Email</label>
                        <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientInfo['clientEmail'])){ echo "value='$clientInfo[clientEmail]'"; } elseif(isset($clientEmail)){ echo "value='$clientEmail'";} ?> required>
                        <br>
                        <input type="submit" id="submitAcc" value="Update">
                        <input type="hidden" name="action" value="updateAccount">
                        <input type="hidden" name="clientId" value="
                            <?php
                                if (isset($_SESSION['clientData']['clientId'])) {
                                    echo $_SESSION['clientData']['clientId'];
                                } elseif (isset($clientId)) {echo $clientId;}
                            ?>
                        ">
                    </fieldset>
                </form><br>
                <!--Change Password Form-->
                <form method="post" action="/phpmotors/accounts/">
                    <fieldset class="form">
                        <legend>Change Password</legend>
                        <label for="clientPassword">New Password</label>
                        <br><span>All passwords have 8+ characters, at least 1 uppercase, number, and special character.</span>
                        <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <br>
                        <!--<label for="password2">Retype Password</label>
                        <input name="password2" id="password2" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <br>-->
                        <input type="submit" id="submitPass" value="Change Password">
                        <input type="hidden" name="action" value="updatePassword">
                        <input type="hidden" name="clientId" value="
                            <?php
                                if (isset($_SESSION['clientData']['clientId'])) {
                                    echo $_SESSION['clientData']['clientId'];
                                } elseif (isset($clientId)) {echo $clientId;}
                            ?>
                        ">
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