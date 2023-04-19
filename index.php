<?php
    if(empty($_SESSION["sessionid"]));
    header("Location: landingpage.php",true,301);

?>


<h1>This is index.php</h1>
<a href="login.php">Login</a>
<br>
<a href="landingpage.php">Landingpage</a>
<br>
<a href="test.php">Test</a>
