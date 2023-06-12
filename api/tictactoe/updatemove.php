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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['lobbyid']) && isset($data['cell'])) {
        $pattern ="/[1-9][0-9]/";
        if(preg_match($pattern,$data['cell'])){
            $sql = "SELECT * FROM moves_tictactoe WHERE lobbyid = ? AND movetype = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $data['lobbyid'],$data['cell']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==0){
                $stmt->close();
                $sql = "INSERT INTO moves_tictactoe (lobbyid, playerid, movetype) 
                VALUES (?, ?, ?)";
                $stmt = $mysqli->prepare($sql);
                echo($data['lobbyid'] & $data['cell']);
                $stmt->bind_param("iis", $data['lobbyid'], $_SESSION['id'],$data['cell']);
                $stmt->execute();
                $stmt->close();
                header('HTTP/1.0 200 OK');
                echo('{"response":"ok"}');
            }
            else {
                header('HTTP/1.0 400 Error');
                echo("Zug Existiert schon");
            }
        }
    }
    
    $mysqli->close();

}