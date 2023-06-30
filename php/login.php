<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// Sessioncheck nicht verwenden, weil das
session_start();

// Checken ob User schon eingeloggt
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /php/index.php");
    exit;
}

require_once($root . "/config.php"); // benötigt für Datenbankverbindung

$username = $password = "";
$username_err = $password_err = $login_err = "";
function loadPage() {
    global $root, $username_err, $password_err, $login_err;
    $pageStyles = '<link rel="stylesheet" href="/css/login.css">';
    $pageTitle = "Login";
    ob_start();
    include($root . "/content/login.php");
    $pageContent = ob_get_clean();
    include_once($root . "/php/master.php");
}


?>
<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    loadPage();
}
// Formdaten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checken ob alle Variablen gesetzt sind
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validität checken
    if (empty($username_err) && empty($password_err)) {
        
        // Accountsperre checken
        $sqlEnabled = "SELECT * FROM users WHERE username = ? AND enabled = 0";
        if($stmtEnabled = $mysqli->prepare($sqlEnabled)){
            $stmtEnabled->bind_param("s", $param_username);
            $param_username = $username;
            if($stmtEnabled->execute()){
                $stmtEnabled->store_result();
                if($stmtEnabled->num_rows > 0){ //Nur erfüllt wenn Accound gesperrt
                    $login_err = "Dein Account wurde gesperrt!";
                    loadPage();
                    $stmtEnabled->close();
                    $mysqli->close();
                    exit();
                }
            }
        }
        
        // SQL mit allen daten
        $sql = "SELECT id, username, password, admin, email, created_at FROM users WHERE username = ? AND enabled = 1";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $stmt->store_result();

                // Check ob Username existiert
                if ($stmt->num_rows == 1) {
                    // Resultate speichern
                    $stmt->bind_result($id, $username, $hashed_password, $admin, $email, $created_at);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Wenn passwort korrekt, neue Session
                            session_start();
                            // Daten als Sessionvariablen speichern
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["email"] = $email;
                            $_SESSION["created_at"] = $created_at;

                            // Weiterleten
                            header("location: landingpage.php");
                        } else {// Passwort inkorrekt
                            $login_err = "Invalides Passwort.";
                            loadPage();
                        }
                    }
                } else {// Username existiert nicht
                    $login_err = "Invalider Username.";
                    loadPage();
                }
            } else { //SQL error
                echo "Oops! Something went wrong. Please try again later.";
                loadPage();
            }

            // Close statement
            $stmt->close();
        }
    } else {
        loadPage();
    }

    // Close connection
    $mysqli->close();
}
?>