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
            <div class="mx-auto col-md-12 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="mb-0">Passwort ändern?</p>
                            </div>
                            <div class="col-sm-12">
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
</section>