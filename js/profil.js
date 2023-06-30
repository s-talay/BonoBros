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
                    $("#error-dialog").text("Das Passwort ist inkorrekt!");
                    $("#error-dialog").dialog("open");
                    return;
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
