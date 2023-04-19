<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <header></header>
    <?php
        // Initialize the session
        session_start();
        
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: index.php");
            exit;
        }
        
        // Include config file
        require_once "config.php";
        
        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = $login_err = "";
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter username.";
            } else{
                $username = trim($_POST["username"]);
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $password = trim($_POST["password"]);
            }
            
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT id, username, password FROM users WHERE username = ?";
                
                if($stmt = $mysqli->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("s", $param_username);
                    
                    // Set parameters
                    $param_username = $username;
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Store result
                        $stmt->store_result();
                        
                        // Check if username exists, if yes then verify password
                        if($stmt->num_rows == 1){                    
                            // Bind result variables
                            $stmt->bind_result($id, $username, $hashed_password);
                            if($stmt->fetch()){
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;                            
                                    
                                    // Redirect user to welcome page
                                    header("location: welcome.php");
                                } else{
                                    // Password is not valid, display a generic error message
                                    $login_err = "Invalid username or password.";
                                }
                            }
                        } else{
                            // Username doesn't exist, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    $stmt->close();
                }
            }
            
            // Close connection
            $mysqli->close();
        }
    ?>

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
                            <input type="text" id="userLabel" class="form-control form-control-lg" required>
                            <label for="userLabel">Username</label>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4b905666d1.js" crossorigin="anonymous"></script>
    <footer
        class="footer d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2027. All lefts reserved.
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>