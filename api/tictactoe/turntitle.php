<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root."/bits/apisessioncheck.php");

require($root."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    #searches for lobbys with state and playerid
    if (isset($_GET['lobbyid'])) {
        $lobbyid = $_GET['lobbyid'];
        $state = "running";
        $stmt = $mysqli->prepare("SELECT l.lobbyid,l.state,g.gamename as 'Game', us1.Username as 'User1', us2.Username as 'User2'
                                FROM lobby as l
                                join users AS us1 ON us1.id = l.player1id 
                                join users AS us2 ON us2.id = l.player2id
                                join game AS g ON g.gameid = l.gameid
                                WHERE l.lobbyid = ?");
        $stmt->bind_param("i", $lobbyid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
            echo json_encode($data);
        } 
    }
    else {
        header('HTTP/1.0 400 Bad Request');
        echo("no lobbyid given");
        die;
    }
}
?> 