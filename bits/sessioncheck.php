<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') {
        header("Location: landingpage.php", true, 301);
    }
} else {
    header("Location: login.php", true, 301);
}
echo "TEST";
?>