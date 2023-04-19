<?php
$pageLinks='    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">';

$pageTitle = "Amogus";

$pageContent = '
    <section class="mb-auto">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="img/BonoBrosLogo.png" class="img-fluid" alt="Logo">
                </div>
                <div class="pt-4 col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form class="pt-4" method="POST">
                        <h3 class="mb-4">Login</h3>

                        <!-- Email input -->
                        <div class="form-floating mb-4">
                            <input type="email" id="emailLabel" class="form-control form-control-lg" required>
                            <label for="emailLabel">E-Mail-Addresse</label>
                        </div>


                        <div class="form-floating mb-4">
                            <input type="password" id="passwordLabel" class="form-control form-control-lg" required>
                            <label for="passwordLabel">Passwort</label>
                        </div>


                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="saveDataCheckbox" />
                                <label class="form-check-label" for="saveDataCheckbox">
                                    Anmelde Daten speichern
                                </label>
                            </div>
                            <a href="#!" class="text-body">Passwort vergessen?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Noch kein Mitglied? <a href="#!"
                                    class="link-danger">Registrieren</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="padding"></div>
    '; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4b905666d1.js" crossorigin="anonymous"></script>

<?php include_once("master.php");?>
