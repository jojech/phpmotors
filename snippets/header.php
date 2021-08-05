<div id="header_flex">
    <a href="/" title="Go to the PHP Motors home page">
        <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
    </a>
    <div>
        <?php 
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                // echo "<span>Welcome $_SESSION[clientData][clientFirstname]</span>";
                echo '<a href="/phpmotors/accounts/" class="logButton">Welcome ',$_SESSION['clientData']['clientFirstname'],'</a>';
                echo '<a href="/phpmotors/accounts/index.php?action=Logout" title="Log out of the session" class="logButton">Logout</a>';
            } 
            else {
                echo '<a href="/phpmotors/accounts/index.php?action=login" title="Log in or Sign up" class="logButton">My Account</a>';
            }
        ?>
    </div>
</div>
