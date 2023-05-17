<div class="padding"></div>
<div id="form-wrapper" class="mx-auto text-center">
    <form class="mx-auto form-signin" action="/php/register.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Registrieren</h1>

        <label for="emailLabel" class="visually-hidden">Email address</label>
        <?php
            $success = '<input type="email" name="email" id="emailLabel" class="form-control is-invalid" placeholder="E-Mail" required="">';
            $fail = '<input type="email" name="email" id="emailLabel" class="form-control" placeholder="E-Mail" required="">';
            $result = (!empty($email_err) ? $success : $fail);
            echo $result;
        ?>

        <span class="invalid-feedback">
            <?php 
            echo $email_err; 
            ?>
        </span>

        <label for="usernameLabel" class="visually-hidden">Username</label>
        <input type="text" name="username" id="usernameLabel"
        <?php echo (!empty($username_err)) ? 'class="form-control is-invalid"' : 'class="form-control"'; ?> placeholder="Username"
            required="">
        <span class="invalid-feedback">
            <?php echo $username_err; ?>
        </span>

        <label for="passwordLabel" class="visually-hidden">Password</label>
        <input type="password" name="password" id="passwordLabel"
        <?php echo (!empty($password_err)) ? 'class="form-control is-invalid"' : 'class="form-control"'; ?> placeholder="Passwort"
            required="">
        <span class="invalid-feedback">
            <?php echo $password_err; ?>
        </span>

        <label for="confirmPasswordLabel" class="visually-hidden">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirmPasswordLabel"
             <?php echo (!empty($confirm_password_err)) ? 'class="form-control is-invalid"' : 'class="form-control"'; ?>
            placeholder="Passwort wiederholen" required="">
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
        //TODO check password
    </script>
</div>