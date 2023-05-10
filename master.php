<?php
if (!basename($_SERVER['PHP_SELF']) == 'login.php' && !basename($_SERVER['PHP_SELF']) == 'register.php') {
    include_once("bits/sessioncheck.php");
}
?>
<!DOCTYPE html>
<html class="h-100" lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include_once("bits/stylelinks.php");
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
    include_once("bits/header.php");
    if (isset($pageContent)) {
        echo $pageContent;
    } else {
        echo "Error Loading Page";
    }
    include_once("bits/footer.php");
    include_once("bits/scripts.php");

    if (isset($pageScripts)) {
        echo $pageScripts;
    }
    ?>
</body>

</html>