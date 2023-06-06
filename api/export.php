<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../config.php";
session_start();

function check_session() :bool {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        return true;
    } else {
        return false;
    }
}


if(!check_session()){
    header('HTTP/1.0 403 Forbidden');
    die;
} 

header ("Content-Type: application/json");
header ("Content-disposition: attachment; filename=export.json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    if(isset($_GET['state'])) {
        $state = $_GET['state'];
        $stmt = $mysqli->prepare("SELECT * FROM lobby WHERE state = ?");
        $stmt->bind_param("s", $state);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM lobby";
        $result = $mysqli->query($sql);
    }

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
?>