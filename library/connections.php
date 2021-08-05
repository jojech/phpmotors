<?php 

function phpmotorsConnect() {
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'proxy';
    $password = 'phpdatauser1';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // MAKE SURE TO FIX THE LINK //
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}
phpmotorsConnect();

?>