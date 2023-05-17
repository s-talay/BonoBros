<?php
$root = $_SERVER['DOCUMENT_ROOT'];
if (!basename($_SERVER['PHP_SELF']) == 'login.php' && !basename($_SERVER['PHP_SELF']) == 'register.php') {
    include_once($root."/bits/sessioncheck.php");
}
?>

<?php
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
    <base href="/">
    <?php
    include_once($root."/bits/stylelinks.php");
    if (isset($pageStyles)) {
        echo $pageStyles;
    }

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
    include_once($root."/bits/header.php");
    if (isset($pageContent)) {
        echo $pageContent;
    } else {
        echo "Error Loading Page";
    }
    include_once($root."/bits/footer.php");
    include_once($root."/bits/scripts.php");

    if (isset($pageScripts)) {
        echo $pageScripts;
    }
    ?>
</body>

</html>