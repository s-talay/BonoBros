<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /php/index.php");
    exit();
}

require_once($root . "/config.php");


// Define variables and initialize with empty values
$email = $username = $password = $confirm_password = "";
$email_err = $username_err = $password_err = $confirm_password_err = "";

function loadPage()
{
    global $root;
    global $email_err;
    global $username_err;
    global $password_err;
    global $confirm_password_err;
    $pageStyles = '<link rel="stylesheet" href="/css/register.css">';
    $pageTitle = "Registrieren";
    ob_start(); // Start output buffering
    include($root . "/content/register.php");
    $pageContent = ob_get_clean(); // Get the contents of the included file and clear the buffer
    include_once($root . "/php/master.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    loadPage();
}



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $email_err = "This E-Mail has already been used.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_email, $param_username, $param_password);

            // Set parameters
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                // header("Location: login.php");
                $stmt->close(); // Close statement
                echo "<script>window.location.href = '/php/login.php';</script>";
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                $stmt->close(); // Close statement
            }
        } else {
        }
    } else {
        loadPage();//lädt jetzt mit den err Variablen gesetzt, also gibt einen Error zurück
    }

    // Close connection
    $mysqli->close();
}
