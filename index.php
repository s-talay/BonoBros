<?php
    if(empty($_SESSION["sessionid"]));
    header("Location: landingpage.php",true,301);
    exit();
?>
