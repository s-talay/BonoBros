<nav class="navbar navbar-light shadow-sm">
    <div class="container mx-auto col-lg-12">
        <style>
            .neon-rainbow {
                animation: blink 1s infinite;
            }

            @keyframes blink {
                0% {
                    color: #ff00ff;
                }

                14% {
                    color: #bf00ff;
                }

                28% {
                    color: #8000ff;
                }

                42% {
                    color: #4000ff;
                }

                57% {
                    color: #0000ff;
                }

                71% {
                    color: #00ffff;
                }

                85% {
                    color: #00ffbf;
                }

                100% {
                    color: #00ff80;
                }
            }
        </style>
        <a href="/" class="navbar-brand col-lg-4 d-flex justify-content-start">
            <img src="/img/BonoBros-Logo.png" width="180" alt="Logo">
        </a>

        <div class="col-lg-3 text-center justify-content-center my-auto">
            <h4><p class="neon-rainbow mx-0 my-auto" id="usertext"></p></h4>
        </div>

        <?php
        if (isset($_SESSION["loggedin"])) {
        ?>
            <script>
                var UserID;
                var UserName;
                var userIDAjax = new XMLHttpRequest();
                userIDAjax.open("GET", "/api/userid.php", false);
                userIDAjax.onreadystatechange = function() {
                    var jsonRes = JSON.parse(userIDAjax.responseText);
                    UserID = jsonRes.id;
                    UserName = jsonRes.username;
                }
                userIDAjax.send();

                var tag = $("#usertext");
                var text = ("Hello " + UserName + "!");
                tag.text(text);
            </script>
        <?php } ?>

        <div class="col-lg-4 text-center justify-content-end" id="new">

            <?php
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                echo "<button class='btn btn-lg btn-warning mx-2' onclick='admin()'>Admin</button>";
            }
            if (basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "register.php") {
                echo "<button class='btn btn-lg btn-primary mx-2' onclick='profil()'>Profil</button>";
                echo "<button class='btn btn-lg btn-danger mx-2' onclick='logout()'>Logout</button>";
            }
            ?>
        </div>

        <script>
            function logout() {
                window.location.href = "/php/logout.php";
            }

            function profil() {
                window.location.href = "/php/profil.php";
            }

            <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) { ?>

                function admin() {
                    window.location.href = "/php/admin.php";
                }
            <?php } ?>
        </script>
    </div>
</nav>