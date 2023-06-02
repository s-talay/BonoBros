<nav class="navbar navbar-light shadow-sm">
    <div class="container">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="/img/BonoBros-Logo.png" width="280" alt="Logo">            
        </a>
        <div>
            <?php
            if($_SESSION["admin"] == 1){
                echo "<button class='btn btn-lg btn-warning mx-2' onclick='admin()'>Admin</button>";
            }
            if(basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "register.php"){
                echo "<button class='btn btn-lg btn-danger' onclick='logout()'>Logout</button>";
            }
            ?>
        </div>
        
        <script>
            function logout(){
                window.location.href = "/php/logout.php";
            }
            <?php if($_SESSION["admin"] == 1){?>
                function admin(){
                    window.location.href = "/php/admin.php";
                }
            <?php }?>
        </script>
    </div>
</nav>