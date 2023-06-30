<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root . "/bits/apisessioncheck.php");

require_once($root . "/config.php"); // benötigt für Datenbankverbindung

header("Content-Type: application/json");
header("Content-disposition: attachment; filename=export.json");

//Export Anfrage handling
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    if (isset($_GET['state'])) { // Für Lobbydaten
        $state = $_GET['state'];
        $stmt = $mysqli->prepare("SELECT * FROM lobby WHERE state = ?");
        $stmt->bind_param("s", $state);
        $stmt->execute();
        $result = $stmt->get_result();
    } else { // Für Admin Datenexport
        if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) { //Falls kein Admin, keine Daten senden
            header("location: " . $root . "/404.php");
            exit();
        }
        // Abfragen ALLER Daten
        $sql = "SELECT * FROM users";
        $result = $mysqli->query($sql);
    }

    if ($result->num_rows > 0) {
        // Output data of each row
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "0 results";
    }
    $mysqli->close();

}
?>