<?php
$pageStyles = '<link rel="stylesheet" href="css/login.css">';
$pageTitle = "Login";
$pageContent = file_get_contents("content/login.php");
    include_once("master.php"); 

$sname= "localhost";
?>
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
$unmae= "root";

$password = "";

$db_name = "test";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
session_start();
if(isset($_POST["email"]) && isset($_POST["password"])){
    function validate($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
 
        return $data;
 
     }
     $email = validate($_POST["email"]);
     $password = validate($_POST["password"]);

     $sql = "SELECT * FROM `login test` WHERE email='$email' AND password='$password';";
     $result = mysqli_query($conn, $sql);
     if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row["email"] == $email && $row["password"] == $password){
            echo "Logged in!";
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            header("Location: landingpage.php");
            exit();
        }
     }
}
?>
<!-- <?php
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
    ?> -->