<?php
//root variable überall für einfachheit
$root = $_SERVER['DOCUMENT_ROOT'];

if (isset($_GET["ajax"])) {
    $ajax = $_GET["ajax"];
    if ($ajax == "") {
    } else if ($ajax == "") {
    }
    exit();
}


// Session Zustand checken
if (!basename($_SERVER['PHP_SELF']) == 'login.php' && !basename($_SERVER['PHP_SELF']) == 'register.php') {
    include_once($root . "/bits/sessioncheck.php");
}

function logout()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: /php/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html class="h-100" lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/favicon.ico">
    <base href="/">
    <?php
    include_once($root . "/bits/stylelinks.php");
    if (isset($pageStyles)) {
        echo $pageStyles;
    }

    include_once($root . "/bits/scripts.php");
    ?>
    <title>
        <?php
        if (isset($pageTitle)) {
            echo $pageTitle;
        } else {
            echo "BonoBros";
        }
        ?>
    </title>
</head>

<body class="h-100">
    <?php
    include_once($root . "/bits/header.php");
    if (isset($pageContent)) {
        echo $pageContent;
    } else {
        echo "Error Loading Page";
    }
    include_once($root . "/bits/footer.php");
    if (isset($pageScripts)) {
        echo $pageScripts;
    }
    
    ?>
</body>

</html>