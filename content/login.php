<div id="form-wrapper" class="mx-auto my-5 text-center">
    <form class="mx-auto form-signin" action="/php/login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <label for="usernameLabel" class="visually-hidden">Username</label>
        <input type="text" name="username" id="usernameLabel" class="form-control" placeholder="Username" required="">

        <label for="passwordLabel" class="visually-hidden">Password</label>
        <input type="password" name="password" id="passwordLabel" class="form-control" placeholder="Passwort"
            required="">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>
            Noch kein Mitglied?
            <br>
            <a href="/php/register.php">
                Registrieren
            </a>
        </p>
    </form>
</div>