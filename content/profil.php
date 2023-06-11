<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <p class="mb-0">User ID</p>
                        </div>
                        <div class="col-sm-9">
                            <p id="id" class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <p id="username" class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
                            <p class="mb-0">E-Mail</p>
                        </div>
                        <div class="col-sm-9">
                            <p id="email" class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
                            <p class="mb-0">Admin?</p>
                        </div>
                        <div class="col-sm-9">
                            <p id="admin" class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var UserID;
        var UserName;
        var userIDAjax = new XMLHttpRequest();
        userIDAjax.open("GET", "/api/userid.php", true);
        userIDAjax.onreadystatechange = function () {
            var jsonRes = JSON.parse(userIDAjax.responseText);
            UserID = jsonRes.id;
            UserName = jsonRes.username;
            getUserData(UserID,UserName);
        }
        userIDAjax.send();
        function getUserData(UserID,UserName) {
            var url = "/api/profileapi.php";
            var userIDAjax = new XMLHttpRequest();
            userIDAjax.open("GET", url+"?userid="+UserID, true);
            userIDAjax.onreadystatechange = function () {
                var jsonRes = JSON.parse(userIDAjax.responseText);
                UserID = jsonRes.id;
                UserName = jsonRes.username;
                var UserEmail = jsonRes.email;
                var UserAdmin = jsonRes.admin;
                $("#id").text(UserID);
                $("#username").text(UserName);
                $("#email").text(UserEmail);
                $("#admin").text(UserAdmin?"Admin":"Not Admin");
            }
            userIDAjax.send();
        }
    </script>
</section>