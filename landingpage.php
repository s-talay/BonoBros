<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include_once("bits/links.php");
    ?>
    <title>Document</title>
</head>
<body>
    <?php
    include_once("bits/header.php");
    ?>
    <main>
        <div class="px-md-5 mx-md-5 album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <a href="#" class="card shadow-sm">
                            <img src="img/Fortnite.jpg" alt="">
                            <div class="card-body">
                                <p class="card-text">
                                    Fortnite
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">9926 Spieler</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="card shadow-sm">
                            <img src="img/Amogus.jpg" alt="">
                            <div class="card-body">
                                <p class="card-text">
                                    Amogus
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">9926 Spieler</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="card shadow-sm">
                            <img src="img/Mario.jpg" alt="">
                            <div class="card-body">
                                <p class="card-text">
                                    Mario
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">9926 Spieler</small>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <?php
    include_once("bits/footer.php");
    include_once("bits/scripts.php");
    ?>    
</body>
</html>