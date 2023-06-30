<?php
//root variable überall für Einfachheit
$root = $_SERVER['DOCUMENT_ROOT'];

// Session Zustand checken
if (!basename($_SERVER['PHP_SELF']) == 'login.php' && !basename($_SERVER['PHP_SELF']) == 'register.php') {
    include_once($root . "/bits/sessioncheck.php");
}

?>

<!-- Template benutzt in allen Seiten -->
<!DOCTYPE html>
<html class="h-100" lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/BonoBros-Logo.png">
    <base href="/">
    <?php //Stylesheets importieren
    include_once($root . "/bits/stylelinks.php");
    if (isset($pageStyles)) {
        echo $pageStyles;
    }

    include_once($root . "/bits/scripts.php");
    ?>
    <title>
        <?php //Titel setzen
        if (isset($pageTitle)) {
            echo $pageTitle;
        } else {
            echo "BonoBros";
        }
        ?>
    </title>
</head>

<body class="h-100">
    <?php //Header hinzufügen
    include_once($root . "/bits/header.php");
    ?>
    <main>
        <?php //Seiten inhalt hinzufügen
        if (isset($pageContent)) {
            echo $pageContent;
        } else {
            echo "Error Loading Page";
        }
        ?>
    </main>
    <?php // Footer hinzufügen
    include_once($root . "/bits/footer.php");
    if (isset($pageScripts)) {
        echo $pageScripts;
    }
    ?>
</body>
</html>