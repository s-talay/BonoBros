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
    if (isset($_GET['lobbyid'])) {
        $lobbyid = $_GET['lobbyid'];
        $stmt = $mysqli->prepare("SELECT m.movetype as cell,m.playerid as player
                                FROM moves_tictactoe as m
                                WHERE m.lobbyid = ?");
        $stmt->bind_param("i", $lobbyid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(null);
        }
    }
    else {
        header('HTTP/1.0 400 Bad Request');
        echo("no lobbyid given");
        die;
    }
}