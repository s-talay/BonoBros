<div class="padding"></div>
<div id="form-wrapper" class="mx-auto text-center">
    <form class="mx-auto form-signin" action="register.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Registrieren</h1>

        <label for="emailLabel" class="visually-hidden">Email address</label>
        <input type="email" name="email" id="emailLabel"
            class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="E-Mail"
            required="">
        <span class="invalid-feedback">
            <?php echo $email_err; ?>
        </span>

        <label for="usernameLabel" class="visually-hidden">Username</label>
        <input type="text" name="username" id="usernameLabel"
            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" placeholder="Username"
            required="">
        <span class="invalid-feedback">
            <?php echo $username_err; ?>
        </span>

        <label for="passwordLabel" class="visually-hidden">Password</label>
        <input type="password" name="password" id="passwordLabel"
            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Passwort"
            required="">
        <span class="invalid-feedback">
            <?php echo $password_err; ?>
        </span>

        <label for="confirmPasswordLabel" class="visually-hidden">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirmPasswordLabel"
            class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
            placeholder="Passwort wiederholen" required="">
        <span class="invalid-feedback">
            <?php echo $confirm_password_err; ?>
        </span>

        <div class="checkbox mt-3 mb-3">
            <label>
                <input type="checkbox" name="checkbox" id="saveDataCheckbox" value="remember-me">
                Login speichern
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>
            Bereits Mitglied?
            <br>
            <a href="login.php">
                Anmelden
            </a>
        </p>
    </form>
</div>