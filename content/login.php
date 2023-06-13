<div id="form-wrapper" class="mx-auto my-5 text-center">
    <form class="mx-auto form-signin" action="/php/login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <label for="usernameLabel" class="visually-hidden">Username</label>
        <?php
        $success = '<input type="text" name="username" id="usernameLabel" class="form-control is-invalid" placeholder="Username" required="">';
        $fail = '<input type="text" name="username" id="usernameLabel" class="form-control" placeholder="Username" required="">';
        $result = (!empty($username_err) || !empty($login_err) ? $success : $fail);
        echo $result;
        ?>

        <span class="invalid-feedback">
            <?php echo $username_err; ?>
        </span>
        <label for="passwordLabel" class="visually-hidden">Password</label>
        <?php
        $errorClass = (!empty($password_err) || !empty($login_err) ? 'is-invalid' : '');
        ?>
        <input type="password" name="password" id="passwordLabel" class="form-control <?php echo $errorClass; ?>"
            placeholder="Passwort" required="">
        <span class="invalid-feedback">
            <?php echo $username_err; ?>
            <?php echo (!empty($login_err) ? $login_err : "") ?>
        </span>
        <span class="invalid-feedback">
            <?php echo $password_err; ?>
        </span>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Einloggen</button>
        <p>
            Noch kein Mitglied?
            <br>
            <a href="/php/register.php">
                Registrieren
            </a>
        </p>
    </form>
</div>