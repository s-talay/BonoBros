<?php
$pageStyles = '<link rel="stylesheet" href="css/login.css">';
$pageTitle = "Login";
$pageContent = file_get_contents("content/login.html");
    include_once("master.php"); 

$sname= "localhost";

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