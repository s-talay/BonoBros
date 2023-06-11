<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . "/bits/apisessioncheck.php");

require $root . "/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = trim($_POST["password"]);
    $username = $_SESSION["username"];

    $sql = "UPDATE users SET password = ? WHERE username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", password_hash($password, PASSWORD_DEFAULT), $username);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo true;
        } else {
            echo false;
        }

        // Close statement
        $stmt->close();
    }
}

?>