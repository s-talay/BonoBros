<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/apisessioncheck.php");

require_once($root . "/config.php"); // benötigt für Datenbankverbindung

// Abfragen ob ein Spiel beendet wurde oder schon abgeschlossen
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    //searches for lobbys with state and playerid
    if (isset($_GET['lobbyid'])) {
        $lobbyid = $_GET['lobbyid'];
        $stmt = $mysqli->prepare("SELECT if(m.playerid=l.player1id,l.player2id,l.player1id) as currentPlayer,l.state,u.username
                                FROM moves_tictactoe as m
                                join lobby l on m.lobbyid = l.lobbyid
                                left join users u on u.id = l.winnerid
                                WHERE l.lobbyid = ?
                                ORDER BY m.moveid DESC
                                LIMIT 1");
        $stmt->bind_param("i", $lobbyid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // Output data of each row
            $data;
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
            echo json_encode($data);
        } else {
            $lobbyid = $_GET['lobbyid'];
            $stmt = $mysqli->prepare("SELECT l.player1id as currentPlayer,l.state,l.winnerid
                                    FROM lobby l
                                    WHERE l.lobbyid = ?");
            $stmt->bind_param("i", $lobbyid);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                // Output data of each row
                $data;
                while ($row = $result->fetch_assoc()) {
                    $data = $row;
                }
                echo json_encode($data);
            } 
            else {
                echo ('{"active":0}');
                die;
            }

        }
    }
    else {
        header('HTTP/1.0 400 Bad Request');
        echo("no lobbyid given");
        die;
    }
}