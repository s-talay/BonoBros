<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/apisessioncheck.php");

require_once($root . "/config.php"); // benötigt für Datenbankverbindung


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    //searches for lobbys with state and playerid
    if (isset($_GET['lobbyid'])) {
        $lobbyid = $_GET['lobbyid'];
        $state = "running";
        $stmt = $mysqli->prepare("SELECT if(state = 'running',1,0) as active
                                FROM lobby as l
                                WHERE state = ? 
                                AND l.lobbyid = ?");
        $stmt->bind_param("si", $state, $lobbyid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
            echo(json_encode($data));
        } else {
            echo ('{"active":0}');
            die();
        }
    }
    else {
        header('HTTP/1.0 400 Bad Request');
        echo("no lobbyid given");
        die();
    }
}