<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . "/bits/apisessioncheck.php");

require($root . "/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];

    $data = json_decode(file_get_contents('php://input'), true);
    $old_password = trim($data['oldPassword']);
    $new_password = trim($data['newPassword']);
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    //verify old password fehlt
    $verify = verifyPw($username, $old_password);

    if ($verify === true) {
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $hashed_new_password, $username);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo true;
                header("location: /php/logout.php");
            } else {
                echo "SQL Fehler ist eingetreten.";
            }
            // Close statement
            $stmt->close();
        } else {
            echo "SQL Fehler ist eingetreten.";
        }
    } else {
        echo $verify;
    }
}

function verifyPw($user, $pw)
{
    $sqlVerify = "SELECT password FROM users WHERE username = ? AND enabled = 1";
    $hashed_old_password = "";
    global $mysqli;
    if ($stm = $mysqli->prepare($sqlVerify)) {
        $stm->bind_param("s", $user);
        if ($stm->execute()) {
            $stm->store_result();
            if ($stm->num_rows == 1) {
                $stm->bind_result($hashed_old_password);
                if ($stm->fetch()) {
                    if (password_verify($pw, $hashed_old_password)) {
                        return true;
                    } else {
                        return "Das eingegebene Passwort ist falsch.";
                    }
                } else {
                    return "SQL Fehler ist eingetreten. \n fetch failed";
                }
            } else {
                return "SQL Fehler ist eingetreten. \n row num error";
            }
        } else {
            return "SQL Fehler ist eingetreten. \n execute failed";
        }
    } else {
        return "SQL Fehler ist eingetreten. \n prepare statement failed";
    }
}
?>