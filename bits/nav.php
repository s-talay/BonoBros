<nav class="navbar navbar-light shadow-sm">
    <div class="container">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="/img/BonoBros-Logo.png" width="180" alt="Logo">
        </a>
        <div id="new">
            <p id="usertext"></p>
            <?php
            if (isset($_SESSION["loggedin"])) {
                ?>
                <script>
                    var UserID;
                    var UserName;
                    var userIDAjax = new XMLHttpRequest();
                    userIDAjax.open("GET", "/api/userid.php", false);
                    userIDAjax.onreadystatechange = function () {
                        var jsonRes = JSON.parse(userIDAjax.responseText);
                        UserID = jsonRes.id;
                        UserName = jsonRes.username;
                    }
                    userIDAjax.send();

                    var tag = $("#usertext");
                    var text = ("Hello " + UserName + "!");
                    tag.text(text);
                    
                </script>
            <?php }

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

            <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){?>
                function admin(){
                    window.location.href = "/php/admin.php";
                }
            <?php } ?>
        </script>
    </div>
</nav>