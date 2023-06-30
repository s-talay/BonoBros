<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// Session manuell, da sessioncheck weiterleiten würde
session_start();
// Check ob User schon eingeloggt
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /php/index.php");
    exit();
}

require_once($root . "/config.php"); // benötigt für Datenbankverbindung


// Leere Variablen initialisieren
$email = $username = $password = $confirm_password = "";
$email_err = $username_err = $password_err = $confirm_password_err = "";

function loadPage() {
    global $root, $email_err, $username_err, $password_err, $confirm_password_err;
    $pageStyles = '<link rel="stylesheet" href="/css/register.css">';
    //$pageScripts='<script src="/js/register.js"></script>';
    $pageTitle = "Registrieren";
    ob_start();
    include($root . "/content/register.php");
    $pageContent = ob_get_clean();
    include_once($root . "/php/master.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    loadPage();
}



// Formdaten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validierung vom Usernamen
    if (empty(trim($_POST["username"]))) {
        $username_err = "Bitte Usernamen eingeben";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username darf nur alphanumerische Zeichen und Unterstriche beinhalten.";
    } else {
        // SQL
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                // Werte speichern
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "Der Username ist bereits vergeben.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Ups! Ein unerwarteter Fehler ist aufgetreten.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validierung von E-Mail
    if (empty(trim($_POST["email"]))) {
        $email_err = "Bitte gebe deine E-Mail-Adresse ein.";
    } else {
        // SQL
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["email"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $email_err = "Diese E-Mail ist bereits vergeben!";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Ups! Ein unerwarteter Fehler ist aufgetreten!";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validierung von Passwort
    if (empty(trim($_POST["password"]))) {
        $password_err = "Bitte gebe ein Passwort ein.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Das Passwort muss mindestens 6 Zeichen lang sein.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validierung von Passwortwiederholung
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Bitte Passwort nochmal eingeben.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Die Passwörter stimmen nicht überein.";
        }
    }

    // Check ob Fehler existieren
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // SQL Insert um User zu registrieren
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $param_email, $param_username, $param_password);

            // Set parameters
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Passwordhash erzeugen

            // SQL ausführen
            if ($stmt->execute()) {
                // Redirect to login page
                // header("Location: login.php"); // Geht warum auch immer nicht
                $stmt->close(); // Close statement
                echo "<script>window.location.href = '/php/login.php';</script>"; // Dieser redirect geht aber
                exit();
            } else {
                echo "Ups! Ein unerwarteter Fehler ist aufgetreten!";
                $stmt->close(); // Close statement
            }
        } else {
        }
    } else {
        loadPage(); //lädt jetzt mit den err Variablen gesetzt, also gibt einen Error in visueller form zurück
    }

    // Close connection
    $mysqli->close();
}