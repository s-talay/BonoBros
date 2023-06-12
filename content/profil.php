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
                                    <button id="changePassword" type="button"
                                        class="btn btn-primary mt-2">Ändern</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dialog-form" title="Passwort ändern">
            <form>
                <fieldset>
                    <label for="currentPassword">Aktuelles Password</label>
                    <input type="password" name="currentPassword" id="currentPassword"
                        class="text ui-widget-content ui-corner-all">

                    <label for="newPassword">Neues Passwort</label>
                    <input type="password" name="newPassword" id="newPassword"
                        class="text ui-widget-content ui-corner-all">

                    <label for="confirmPassword">Bestätige neues Passwort</label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                        class="text ui-widget-content ui-corner-all">
                </fieldset>
            </form>
        </div>

        <div id="dialog-confirm" title="Bist du dir Sicher?">
            <p>Bist du dir sicher, dass du dein Passwort ändern willst?</p>
        </div>
        <div id="error-dialog" title="Fehler"></div>
        <div id="success-dialog" title="Password geändert"></div>
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
                var newPassword;
                var currentPassword;
                var dialog, form,

                    dialog = $("#dialog-form").dialog({
                        autoOpen: false,
                        height: 400,
                        width: 350,
                        modal: true,
                        buttons: {
                            "Passwort ändern": function () {
                                currentPassword = $("#currentPassword").val();
                                newPassword = $("#newPassword").val();
                                var confirmPassword = $("#confirmPassword").val();

                                if (currentPassword == "" || newPassword == "" || confirmPassword == "") {
                                    $("#error-dialog").text("Du musst alle Felder ausfüllen!");
                                    $("#error-dialog").dialog("open");
                                    return;
                                }

                                if (newPassword !== confirmPassword) {
                                    $("#error-dialog").text("Die Passwörter stimmen nicht überein!");
                                    $("#error-dialog").dialog("open");
                                    return;
                                }

                                if (newPassword == currentPassword) {
                                    $("#error-dialog").text("Das alte und neue Passwort sind identisch!");
                                    $("#error-dialog").dialog("open");
                                    return;
                                }

                                if (newPassword.length < 6 || confirmPassword.length < 6) {
                                    $("#error-dialog").text("Passwörter müssen mindestens 6 Zeichen lang sein");
                                    $("#error-dialog").dialog("open");
                                    return;
                                }

                                $("#dialog-confirm").dialog("open");
                            },
                            "Abbruch": function () {
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
                        "Ja, ich bin mir sicher": async function () {
                            try {
                                var check = await checkPassword(currentPassword, newPassword);
                                if (check === true) {
                                    console.log("path 1");
                                    $(this).dialog("close");
                                    dialog.dialog("close");
                                    $("#success-dialog").text("Dein Password wurde erfolgreich geändert!");
                                    $("#success-dialog").dialog("open");
                                    return;
                                } else {
                                    console.log("path 2");
                                    $("#error-dialog").text(check);
                                    $("#error-dialog").dialog("open");
                                    return;
                                }
                            } catch (error) {
                                console.error(error);
                            }

                        },
                        "Nein,doch nicht": function () {
                            $(this).dialog("close");
                        }
                    }
                });

                $("#error-dialog").dialog({
                    autoOpen: false, // Do not open the dialog by default
                    modal: true, // Make the dialog modal
                    buttons: {
                        OK: function () {
                            $(this).dialog("close"); // Close the dialog when "OK" is clicked
                        }
                    }
                });
                $("#success-dialog").dialog({
                    autoOpen: false, // Do not open the dialog by default
                    modal: true, // Make the dialog modal
                    buttons: {
                        OK: function () {
                            $(this).dialog("close"); // Close the dialog when "OK" is clicked
                            location.reload();
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
        <script>
            async function checkPassword(oldPassword, newPassword) {
                try {
                    const response = await $.ajax({
                        url: '/api/passwordchange.php',
                        type: 'POST',
                        data: JSON.stringify({ oldPassword: oldPassword, newPassword: newPassword }),
                        contentType: "application/json",
                        dataType: "json"
                    });
                    return response === 1 ? true : response;
                } catch (error) {
                    return error;
                }
            }

        </script>
</section>