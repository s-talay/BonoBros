<div class="padding"></div>
<div id="form-wrapper" class="mx-auto text-center">
    
    <form id="form" class="mx-auto form-signin" action="/php/register.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Registrieren</h1>

        <label for="emailLabel" class="visually-hidden">Email address</label>
        <?php
        $success = '<input type="email" name="email" id="emailLabel" class="form-control is-invalid" placeholder="E-Mail" required="">';
        $fail = '<input type="email" name="email" id="emailLabel" class="form-control" placeholder="E-Mail" required="">';
        $result = (!empty($email_err) ? $success : $fail);
        echo $result;
        ?>
        <span class="invalid-feedback">
            <?php echo $email_err; ?>
        </span>

        <label for="usernameLabel" class="visually-hidden">Username</label>
        <?php
        $success = '<input type="text" name="username" id="usernameLabel" class="form-control is-invalid" placeholder="Username" required="">';
        $fail = '<input type="text" name="username" id="usernameLabel" class="form-control" placeholder="Username" required="">';
        $result = (!empty($username_err) ? $success : $fail);
        echo $result;
        ?>
        <span class="invalid-feedback">
            <?php echo $username_err; ?>
        </span>

        <label for="passwordLabel" class="visually-hidden">Password</label>
        <?php
        $errorClass = (!empty($password_err) ? 'is-invalid' : '');
        ?>
        <input type="password" name="password" id="passwordLabel" class="form-control <?php echo $errorClass; ?>" placeholder="Passwort" required="">

        <span class="invalid-feedback">
            <?php echo $password_err; ?>
        </span>

        <label for="confirmPasswordLabel" class="visually-hidden">Confirm Password</label>
        <?php
        $success = '<input type="password" name="confirm_password" id="confirmPasswordLabel" class="form-control is-invalid" placeholder="Passwort bestätigen" required="">';
        $fail = '<input type="password" name="confirm_password" id="confirmPasswordLabel" class="form-control" placeholder="Passwort bestätigen" required="">';
        $result = (!empty($confirm_password_err) ? $success : $fail);
        echo $result;
        ?>
        <span class="invalid-feedback">
            <?php echo $confirm_password_err; ?>
        </span>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>
            Bereits Mitglied?
            <br>
            <a href="/php/login.php">
                Anmelden
            </a>
        </p>
    </form>
    <script>
        const regex = new RegExp("/^[a-zA-Z0-9_]+$/");
        const form = $("#form");
        form.submit((event)=>{
            event.preventDefault();
            function openDialog(message) {
            // $('<div>' + message + '</div>').dialog({
            //     modal: true,
            //     title: 'Fehler',
            //     buttons: {
            //     Ok: function() {
            //         $(this).dialog('close');
            //     }
            //     }
            // });
            $("<div>Test message</div>").dialog();
            }
            

            const nameInput = $("#usernameLabel");
            if(regex.test(nameInput)){
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                    },
                    error: function(error) {
                        openDialog(error);
                    }
                });
            }else{
                openDialog("Username ist kacke");
            }
        });
    </script>
    <script>
        // const form = $("#form");
        
        // form.addEventListener("submit", submitForm);
    </script>
</div>