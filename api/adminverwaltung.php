<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/apisessioncheck.php");

// Wenn kein Admin, so tun als würde die Seite gar nicht existieren
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    header("location: ".$root."/404.php");
}

require_once($root . "/config.php"); // benötigt für Datenbankverbindung

// PATCH genutzt von de-/aktivieren von User und pro-/demoten von Admins
if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $data = json_decode(file_get_contents('php://input'), true);   
    // von Client immer nur ein Wert anders als der Wert der Datenbank, geht theoretisch aber auch beides gleichzeitig
    if(isset($data['admin']) AND isset($data['enabled']) AND isset($data['id'])) { 
        $sql = "UPDATE users SET admin=?,enabled=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iii",$data['admin'],$data['enabled'],$data['id']);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }
    else echo "Fehler";

}
// Tabellendaten liefern
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