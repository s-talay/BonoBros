<?php
$root = $_SERVER['DOCUMENT_ROOT'];
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /php/index.php");
    exit;
}

require_once $root . "/config.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";
function loadPage(){
    global $root;
    global $username_err;
    global $password_err;
    global $login_err;
    $pageStyles = '<link rel="stylesheet" href="/css/login.css">';
    $pageTitle = "Login";
    ob_start(); // Start output buffering
    include($root . "/content/login.php");
    $pageContent = ob_get_clean(); // Get the contents of the included file and clear the buffer
    include_once($root . "/php/master.php");
}

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    loadPage();
}
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, admin, email, created_at FROM users WHERE username = ? AND enabled = 1";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password, $admin, $email, $created_at);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["email"] = $email;
                            $_SESSION["created_at"] = $created_at;


                            // Redirect user to welcome page
                            header("location: landingpage.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                            loadPage();
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                    loadPage();
                }
            } else {
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