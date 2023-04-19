<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include_once("bits/links.php");
    echo $pageStyles
    ?>
    <title><?php echo $pageTitle ?></title>
</head>

<body>
    <?php
    include_once("bits/header.php");
    echo $pageContent;
    include_once("bits/footer.php");
    include_once("bits/scripts.php");
    ?>
</body>

</html>