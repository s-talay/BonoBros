<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $pageLinks?>
    <title><?php echo $pageTitle?></title>
</head>
<body>
    <?php 
    include_once("bits/header.php");
    echo $pageContent;
    include_once("bits/footer.php");
    ?>
</body>
</html>