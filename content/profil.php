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
        <div class="row">
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
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <p class="mb-0">Erstellt am</p>
                            </div>
                            <div class="col-sm-9">
                                <p id="created_at" class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-0">Passwort ändern?</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button id="changePassword" type="button" onclick="changePassword();"
                                        class="btn btn-primary mt-2">Ändern</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dialog-form" title="Change Password">
            <form>
                <fieldset>
                    <label for="currentPassword">Current Password</label>
                    <input type="password" name="currentPassword" id="currentPassword"
                        class="text ui-widget-content ui-corner-all">

                    <label for="newPassword">New Password</label>
                    <input type="password" name="newPassword" id="newPassword"
                        class="text ui-widget-content ui-corner-all">

                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                        class="text ui-widget-content ui-corner-all">
                </fieldset>
            </form>
        </div>

        <div id="dialog-confirm" title="Confirm Action">
            <p>Bist du dir sicher, dass du dein Passwort ändern willst?</p>
        </div>
        <script></script>
        <script>
            var UserID;
            var UserName;
            var userIDAjax = new XMLHttpRequest();
            userIDAjax.open("GET", "/api/userid.php", true);
            userIDAjax.onreadystatechange = function () {
                var jsonRes = JSON.parse(userIDAjax.responseText);
                UserID = jsonRes.id;
                UserName = jsonRes.username;
                requestAndDisplayerUserData(UserID);
            }
            userIDAjax.send();

            function requestAndDisplayerUserData(id) {
                var url = "/api/profileapi.php";
                var userDataAjax = new XMLHttpRequest();
                userDataAjax.open("GET", url + "?userid=" + id, true);
                userDataAjax.onreadystatechange = function () {
                    var jsonRes = JSON.parse(userDataAjax.responseText);

                    var idField = jsonRes.id;
                    var nameField = jsonRes.username;
                    var emailField = jsonRes.email;
                    var adminField = jsonRes.admin;
                    var created_atField = jsonRes.created_at;

                    $("#id").text(idField);
                    $("#username").text(nameField);
                    $("#email").text(emailField);
                    $("#admin").text(adminField ? "Admin" : "Not Admin");
                    $("#created_at").text(created_atField);
                }
                userDataAjax.send();
            }
        </script>

        <script>
            $(function () {
                var dialog, form,

                    dialog = $("#dialog-form").dialog({
                        autoOpen: false,
                        height: 400,
                        width: 350,
                        modal: true,
                        buttons: {
                            "Change password": function () {
                                $("#dialog-confirm").dialog("open");
                            },
                            Cancel: function () {
                                dialog.dialog("close");
                            }
                        },
                        close: function () {
                            form[0].reset();
                        }
                    });

                $("#dialog-confirm").dialog({
                    autoOpen: false,
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        "Yes, I'm sure": function () {
                            $(this).dialog("close");
                            dialog.dialog("close");
                            // Add here your function to send the form data to your server.
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });

                form = dialog.find("form").on("submit", function (event) {
                    event.preventDefault();
                });

                $("#changePassword").button().on("click", function () {
                    dialog.dialog("open");
                });
            });

        </script>

</section>