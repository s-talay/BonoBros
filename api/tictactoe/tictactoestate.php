<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../../config.php";
session_start();

function check_session(): bool
{
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        return true;
    } else {
        return false;
    }
}


if (!check_session()) {
    header('HTTP/1.0 403 Forbidden');
    die;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    #searches for lobbys with state and playerid
    if (isset($_GET['lobbyid'])) {
        $lobbyid = $_GET['lobbyid'];
        $stmt = $mysqli->prepare("SELECT if(m.playerid=l.player1id,l.player2id,l.player1id) as currentPlayer,l.state,l.winnerid
                                FROM moves_tictactoe as m
                                join lobby l on m.lobbyid = l.lobbyid
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
        } 
        else {
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