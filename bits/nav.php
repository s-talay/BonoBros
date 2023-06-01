<nav class="navbar navbar-light shadow-sm">
    <div class="container">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="/img/BonoBros-Logo.png" width="280" alt="Logo">            
        </a>
        <?php
            if($_SESSION["admin"] == 1){
                echo "<button class='btn btn-lg btn-danger' onclick='logout()'>Admin</button>";
            }
            if(basename($_SERVER["PHP_SELF"]) != "login.php" && basename($_SERVER["PHP_SELF"]) != "register.php"){
                echo "<button class='btn btn-lg btn-danger' onclick='logout()'>Logout</button>";
            }
        ?>
        
        <script>
            function logout(){
                window.location.href = "/php/logout.php";
            }
        </script>
    </div>
</nav>