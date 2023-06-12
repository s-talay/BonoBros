<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../config.php";
session_start();

function check_session() :bool {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
        return true;
    } else {
        return false;
    }
}
if(!check_session()){
    header("HTTP/1.0 404 Not Found");
    include($root."/404.php");
    exit();
} 

if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $data = json_decode(file_get_contents('php://input'), true);   
    if(isset($data['admin'])&&isset($data['enabled'])&&isset($data['id'])) {
        $sql = "UPDATE users SET admin=?,enabled=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iii",$data["admin"],$data["enabled"],$data["id"]);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }
    else echo "Fehler";

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);


    if ($result->num_rows > 0) {
        // Output data of each row
        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "0 results";
    }
    $mysqli->close();

}