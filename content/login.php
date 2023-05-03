<div id="form-wrapper" class="mx-auto my-5 text-center">
    <form class="mx-auto form-signin" action="login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <label for="emailLabel" class="visually-hidden">Email address</label>
        <input type="email" name="email" id="emailLabel" class="form-control" placeholder="E-Mail" required="">

        <label for="passwordLabel" class="visually-hidden">Password</label>
        <input type="password" name="password" id="passwordLabel" class="form-control" placeholder="Passwort"
            required="">

        <div class="checkbox mt-3 mb-3">
            <label>
                <input type="checkbox" name="checkbox" id="saveDataCheckbox" value="remember-me"> Login speichern
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>
            Noch kein Mitglied?
            <br>
            <a href="register.php">
                Registrieren
            </a>
        </p>
    </form>
</div>